<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Album;

class MediaController extends Controller
{
    public function index()
    {
        return redirect(route('projects.index'));
    }

    public function album(Album $album)
    {
        $album->recordView();

        return view('front.media.album', [
            'album' => $album->load('images'),
            'others' => Album::whereKeyNot($album->id)->orderBy('order')->take(6)->get(),
        ]);
    }
}
