<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    use HandlesUploads;

    public function index()
    {
        return view('admin.events.index', [
            'events' => Event::orderByDesc('starts_at')->paginate(20),
        ]);
    }

    public function create()
    {
        return view('admin.events.form', ['event' => new Event(['status' => 'publie', 'starts_at' => now()])]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['cover'] = $this->storeFile($request->file('cover'), 'events');

        Event::create($data);

        return redirect()->route('admin.events.index')->with('success', 'Évènement créé.');
    }

    public function edit(Event $event)
    {
        return view('admin.events.form', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $this->validated($request);

        if ($request->hasFile('cover')) {
            $this->deleteFile($event->cover);
            $data['cover'] = $this->storeFile($request->file('cover'), 'events');
        }

        $event->update($data);

        return redirect()->route('admin.events.index')->with('success', 'Évènement mis à jour.');
    }

    public function destroy(Event $event)
    {
        $this->deleteFile($event->cover);
        $event->delete();

        return back()->with('success', 'Évènement supprimé.');
    }

    protected function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'slug' => ['nullable', 'string', 'max:200'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'body' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:200'],
            'starts_at' => ['required', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'status' => ['required', 'in:publie,brouillon'],
            'cover' => ['nullable', 'image', 'max:4096'],
        ]);

        $data['featured'] = $request->boolean('featured');

        return $data;
    }
}
