<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        return redirect(route('posts.index'));
    }

    public function show(Event $event)
    {
        abort_unless($event->status === 'publie', 404);

        $event->recordView();

        return view('front.events.show', [
            'event' => $event,
            'others' => Event::published()->upcoming()->whereKeyNot($event->id)->take(3)->get(),
        ]);
    }
}
