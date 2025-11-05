<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Google\Client;
use App\Models\Menu;
use Inertia\Inertia;
use App\Models\Event;
use App\Models\Sheet;
use App\Models\Category;
use Google\Service\Sheets;
use App\Models\Reservation;
use App\Helpers\SheetHelper;
use Illuminate\Http\Request;
use App\Http\Resources\EventResource;
use App\Http\Resources\WeeklyEventResource;

class MainController extends Controller
{
    public function index()
    {
        $menu = Menu::orderBy('price')->where('show', true)->limit(4)->get();
        $weekly = WeeklyEventResource::collection(Event::latest('start')->whereNotNull('weekly_day')->get());
        return Inertia::render('Index', [
            'menus' => $menu,
            'weekly' => $weekly,
        ]);
    }
    
    public function events()
    {
        $events = Event::latest('start')->get();
        [$weekly, $others] = $events->partition(function ($event) {
            return $event->weekly_day != null;
        });
        return Inertia::render('Events', [
            'weekly' => WeeklyEventResource::collection($weekly),
            'others' => EventResource::collection($others)
        ]);
    }
    
    public function reservation()
    {
        return Inertia::render('Reservation');
    }
    
    public function reserve(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'date' => ['required'],
            'hour_start' => ['required'],
            'hour_end' => ['required'],
            'agenda' => ['required'],
            'count' => ['required'],
            'phone' => ['required'],
            'type' => ['required'],
            'menu_type' => ['required'],
        ]);
        $data = $request->all();
        $hour_start = explode(':', $data['hour_start']);
        $hour_end = explode(':', $data['hour_end']);
        $data['start'] = now()->setDate($data['date']['year'], $data['date']['month'], $data['date']['day'])->setTimeFromTimeString($data['hour_start']);
        $data['end'] = now()->setDate($data['date']['year'], $data['date']['month'], $data['date']['day'])->setTimeFromTimeString($data['hour_end']);
        if ($data['start'] > $data['end']) {
            return back()->withErrors([
                'hour_start' => 'Jam mulai dan selesai tidak valid',
                'hour_end' => 'Jam mulai dan selesai tidak valid',
            ]);
        }
        if ($data['start']->diffInHours($data['end'], true) > 4) {
            return back()->withErrors([
                'hour_start' => 'Reservasi tidak boleh lebih dari 4 jam',
                'hour_end' => 'Reservasi tidak boleh lebih dari 4 jam',
            ]);
        }
        $start = $data['start']->format('Y-m-d H:i:s');
        $end = $data['end']->format('Y-m-d H:i:s');
        $reservation = Reservation::where('start', '<', $end)->where('end', '>', $start)->get();
        if ($reservation->count()) {
            return back()->withErrors([
                'date' => 'Sudah ada reservasi di antara tanggal dan waktu tersebut',
                'hour_start' => 'Sudah ada reservasi di antara tanggal dan waktu tersebut',
                'hour_end' => 'Sudah ada reservasi di antara tanggal dan waktu tersebut',
            ]);
        }
        unset($data['date']); unset($data['hour_start']); unset($data['hour_end']);
        $sheet = Sheet::where('year', now()->year)->get()->first();
        $data['sheet_id'] = $sheet->id ?? null;
        $reservation = Reservation::create($data);
        if ($reservation) {
            if ($sheet) {
                try {
                    $service = new SheetHelper($sheet->file_id);
                    Carbon::setLocale('id');
                    $month = now()->isoFormat('MMMM');
                    $numbers = $service->getSpreadsheetValues("$month!A5:A");
                    $number = (int) $numbers[count($numbers)-1][0];
                    $service->appendValues([
                        [$number ? $number + 1 : "","RES-$reservation->id", $reservation->start->format('j/n/Y'), '', $reservation->name, $reservation->group ?? "", $reservation->agenda, $reservation->menu_type, $reservation->count, ($reservation->start->format('H:i')." - ".$reservation->end->format('H:i')), $reservation->type]
                    ], ['valueInputOption' => "USER_ENTERED"]);
                } catch (\Throwable $th) {
                    
                }
            }
        }
        return to_route('reservation');
    }
    
    public function menu()
    {
        $menus = Menu::where('show', true)->get()->groupBy('category_id');
        $categories = Category::all();
        return Inertia::render('Menu', ['menus' => $menus, 'categories' => $categories]);
    }
    public function gallery()
    {
        return Inertia::render('Gallery');
    }
    // public function test(Request $request)
    // {
    //     $spreadsheetId = env('GOOGLE_SHEET_ID');
    //     $service = new SheetHelper($spreadsheetId);
    //     // Mengubah status terhadap suatu id
    //     $id = 3;
    //     $id = "RES-$id";
    //     $status = 'Ditolak';
    //     $ids = $service->getSpreadsheetValues("Sheet1!B5:B");
    //     dump($ids);
    //     foreach ($ids as $r => $i) {
    //         if ($i[0] == $id) {
    //             dump($i[0]);
    //             $row = $r+5;
    //             $service->updateValues(
    //                 "M$row",
    //                 [[$status]]
    //             );
    //         }
    //     }

    //     // Tambah Reservasi
    //     $service->appendValues("A5:C5", [[4, "RES-4", '12/9/2025']], ['valueInputOption' => 'USER_ENTERED']);

    //     // dd($values);
    // }
}
