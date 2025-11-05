<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Reservation;
use App\Helpers\SheetHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReservationResource;
use App\Models\Sheet;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search') ?? '';
        $reservations = Reservation::latest('start')->where('name', 'like', "%$search%")->get()->toResourceCollection();
        return Inertia::render('admin/reservation/Index', ['reservations' => $reservations]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('admin/reservation/Tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
        return to_route('admin.reservations.index')->with('alert', ['title' => 'Reservasi berhasil ditambah', 'text' => 'Reservasi juga berhasil tersimpan ke spreadsheet', 'type' => 'success']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reservation = new ReservationResource(Reservation::findOrFail($id));
        return Inertia::render('admin/reservation/Edit', ['reservation' => $reservation]);
    }
    
    /**
     * Update the specified resource in storage.
    */
    public function update(Request $request, string $id)
    {
        $reservation = Reservation::findOrFail($id);
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
        $data['start'] = now()->setDate($data['date']['year'], $data['date']['month'], $data['date']['day'])->setTimeFromTimeString($data['hour_start']);
        $data['end'] = now()->setDate($data['date']['year'], $data['date']['month'], $data['date']['day'])->setTimeFromTimeString($data['hour_end']);
        $reservation->update($data);

        $reservation->refresh();
        $service = new SheetHelper();
        $row = $service->getRowById($id);
        if ($row) {
            $service->updateValues("C$row:K$row", [
                [$reservation->start->format('j/n/Y'), '', $reservation->name, $reservation->group ?? "", $reservation->agenda, $reservation->menu_type, $reservation->count, ($reservation->start->format('H:i')." - ".$reservation->end->format('H:i')), $reservation->type]
            ], ['valueInputOption' => "USER_ENTERED"]);
        }
        
        return to_route('admin.reservations.index')->with('alert', ['title' => 'Reservasi berhasil diedit', 'text' => 'Perubahan juga berhasil tersimpan ke spreadsheet', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Reservation::destroy($id);
        $service = new SheetHelper();
        $row = $service->getRowById($id);
        if ($row) {
            $service->deleteRows($row);
        }
        return to_route('admin.reservations.index');
    }
    
    public function confirm(string $id, Request $request)
    {
        $reservation = Reservation::findOrFail($id);
        $status = "";
        if ($request->accept == true) {
            $status = 'Diterima';
        }
        else if ($request->accept == false) {
            $status = 'Ditolak';
        }
        $reservation->status = $status;
        $reservation->save();
        $service = new SheetHelper();
        $row = $service->getRowById($id);
        if ($row) {
            $service->updateValues("M$row", [[$status]]);
        }
        return to_route('admin.reservations.index');
    }
    
    public function confirmStatus(string $id, Request $request)
    {
        $reservation = Reservation::findOrFail($id);
        $status = $request->accept;
        $reservation->status = $status;
        $reservation->save();
        return response()->json(['success' => true]);
    }
    
}
