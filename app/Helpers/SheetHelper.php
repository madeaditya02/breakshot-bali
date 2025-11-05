<?php

namespace App\Helpers;

use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\BatchUpdateSpreadsheetRequest;

class SheetHelper
{
    public $spreadsheetId;
    protected $service;

    public function __construct($spreadsheetId = null)
    {
        $this->spreadsheetId = $spreadsheetId ?? env('GOOGLE_SHEET_ID');
        $client = new Client();
        $client->setAuthConfig(config('google.service_file'));
        $client->setScopes(config('google.scopes'));

        $this->service = new Sheets($client);
    }

    public function getSpreadsheetValues($range)
    {
        return $this->service->spreadsheets_values
            ->get($this->spreadsheetId, $range)
            ->getValues();
    }

    public function appendValues(array $values, $options = ['valueInputOption' => 'RAW'])
    {
        $range = "B5:M5";
        $body = new Sheets\ValueRange([
            'values' => $values
        ]);

        return $this->service->spreadsheets_values->append(
            $this->spreadsheetId,
            $range,
            $body,
            $options
        );
    }

    public function updateValues($range, array $values, $options = ['valueInputOption' => 'RAW'])
    {
        $body = new Sheets\ValueRange([
            'values' => $values
        ]);

        return $this->service->spreadsheets_values->update(
            $this->spreadsheetId,
            $range,
            $body,
            $options
        );
    }

    public function deleteRows($start, $end = null)
    {
      $requestBody = new BatchUpdateSpreadsheetRequest([
          'requests' => [
              [
                  'deleteDimension' => [
                      'range' => [
                          'sheetId' => 0,
                          'dimension' => 'ROWS',
                          'startIndex' => $start - 1, // baris ke-5 → index 4
                          'endIndex'   => $end ? $end+1 : $start,     // exclusive
                      ]
                  ]
              ]
          ]
      ]);
      return $this->service->spreadsheets->batchUpdate($this->spreadsheetId, $requestBody);
    }

    public function getRowById($id) {
        $row = null;
        $ids = $this->getSpreadsheetValues("Sheet1!B5:B");
        foreach ($ids as $r => $i) {
            if ($i[0] == "RES-$id") {
                $row = $r+5;
            }
        }
        return $row;
    }

    public static function getSheetId(string $url): null | string
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return null;
        }

        // Pastikan domain adalah Google Sheets
        $host = parse_url($url, PHP_URL_HOST);
        if ($host !== 'docs.google.com') {
            return null;
        }

        // Cek apakah mengandung '/spreadsheets/d/'
        if (!preg_match('/\/spreadsheets\/d\/([a-zA-Z0-9-_]+)/', $url, $matches)) {
            return null;
        }

        // Ambil Sheet ID
        return $matches[1] ?? null;
    }
}
