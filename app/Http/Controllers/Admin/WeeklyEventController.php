<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\WeeklyEventResource;

class WeeklyEventController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search') ?? '';
        $events = WeeklyEventResource::collection(Event::latest('start')->whereNotNull('weekly_day')->whereLike('name', "%$search%")->get());
        return Inertia::render('admin/event/Index', ['weekly' => $events, 'type' => 'weekly']);
    }
    
    public function create()
    {
        return Inertia::render('admin/event/weekly/Tambah');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'day' => ['required'],
            'hour' => ['required'],
            'image' => ['required'],
        ]);
        $data = $request->all();
        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = time().".$extension";
            $path = $request->file('image')->storeAs('events/weekly', $fileName, 'public');
            $data['image'] = asset('storage/events/weekly/'.$fileName);
        }
        Event::create([
            'name' => $data['name'],
            'start' => now(),
            'end' => now(),
            'image' => $data['image'],
            'description' => $data['description'],
            'organizer' => 'Breakshot',
            'weekly_day' => $data['day'],
            'weekly_hour' => $data['hour'],
        ]);
        return to_route('admin.events.weekly.index');
    }

    public function edit(string $id)
    {
        $event = new WeeklyEventResource(Event::findOrFail($id));
        return Inertia::render('admin/event/weekly/Edit', ['event' => $event]);
    }

    public function update(string $id, Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'day' => ['required'],
            'hour' => ['required'],
        ]);
        $event = Event::findOrFail($id);
        $data = $request->all();
        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = time().".$extension";
            $path = $request->file('image')->storeAs('events/weekly', $fileName, 'public');
            $event->image = asset('storage/events/weekly/'.$fileName);
        }
        $event->name = $data['name'];
        $event->start = now();
        $event->end = now();
        $event->description = $data['description'];
        $event->organizer = 'Breakshot';
        $event->weekly_day = $data['day'];
        $event->weekly_hour = $data['hour'];
        $event->save();
        return to_route('admin.events.weekly.index');
    }

    public function destroy(string $id)
    {
        Event::destroy($id);
        return to_route('admin.events.weekly.index');
    }
}
