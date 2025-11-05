<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\WeeklyEventResource;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search') ?? '';
        $events = EventResource::collection(Event::latest('start')->whereNull('weekly_day')->whereLike('name', "%$search%")->get());
        return Inertia::render('admin/event/Index', ['others' => $events, 'type' => 'others']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('admin/event/Tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'date' => ['required'],
            'start_time' => ['required']
        ]);
        $data = $request->all();
        $data['start'] = now()->setDate($data['date']['year'], $data['date']['month'], $data['date']['day'])->setTimeFromTimeString($data['start_time']);
        $data['end'] = now()->setDate($data['date']['year'], $data['date']['month'], $data['date']['day'])->setTimeFromTimeString($data['end_time']);
        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = time().".$extension";
            $path = $request->file('image')->storeAs('events', $fileName, 'public');
            $data['image'] = asset('storage/events/'.$fileName);
        }
        unset($data['start_time'], $data['end_time'], $data['date']);
        Event::create($data);
        return to_route('admin.events.index')->with('alert', ['title' => 'Event berhasil ditambah', 'type' => 'success']);
    }

    /**
     * Display the specified resource.
     */
    public function toggle(string $id, Request $request)
    {
        $event = Event::findOrFail($id);
        $event->show = !$event->show;
        $event->save();
        return to_route($request->type == 'weekly' ? 'admin.events.weekly.index' : 'admin.events.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = new EventResource(Event::findOrFail($id));
        return Inertia::render('admin/event/Edit', ['event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required'],
            'date' => ['required'],
            'start_time' => ['required']
        ]);
        $event = Event::findOrFail($id);
        $data = $request->all();
        $data['start'] = now()->setDate($data['date']['year'], $data['date']['month'], $data['date']['day'])->setTimeFromTimeString($data['start_time']);
        $data['end'] = now()->setDate($data['date']['year'], $data['date']['month'], $data['date']['day'])->setTimeFromTimeString($data['end_time']);
        if ($request->file('image')) {
            if ($event->image) {
                $prevFile = Str::of($event->image)->explode('/')->last();
                Storage::disk('public')->delete("events/$prevFile");
            }
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = time().".$extension";
            $path = $request->file('image')->storeAs('events', $fileName, 'public');
            $data['image'] = asset('storage/events/'.$fileName);
        }
        unset($data['start_time'], $data['end_time'], $data['date']);
        $event->update($data);
        return to_route('admin.events.index')->with('alert', ['title' => 'Event berhasil diedit', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Event::destroy($id);
        return to_route('admin.events.index')->with('alert', ['title' => 'Event berhasil dihapus', 'type' => 'success']);
    }
}
