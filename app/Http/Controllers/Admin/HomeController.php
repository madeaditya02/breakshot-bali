<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sheet;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('admin/Dashboard');
    }
    public function closeSheetConfirmation(Request $request)
    {
        $request->session()->put('close-sheet', true);
    }
    public function setSheet(Request $request)
    {
        $data = $request->validate(['url' => 'required']);
        $url = $data['url'];
        $sheetId = null;
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return back()->withErrors(['url' => 'Url tidak valid']);
        }
        
        $host = parse_url($url, PHP_URL_HOST);
        if ($host !== 'docs.google.com') {
            return back()->withErrors(['url' => 'Url tidak valid']);
        }
        
        if (!preg_match('/\/spreadsheets\/d\/([a-zA-Z0-9-_]+)/', $url, $matches)) {
            return back()->withErrors(['url' => 'Url tidak valid']);
        }
        
        // Ambil Sheet ID
        $sheetId = $matches[1] ?? null;
        if ($sheetId) {
            Sheet::create([
                'file_id' => $sheetId,
                'link' => $url,
                'year' => now()->year
            ]);
            $request->session()->put('close-sheet', true);
            return to_route('admin.dashboard');
        }
        return back()->withErrors(['url' => 'Url tidak valid']);
    }
}
