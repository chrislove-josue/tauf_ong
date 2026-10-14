<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Media;

class MediaController extends Controller
{
    public function index()
    {
        return view('front.media.index', [
            'albums' => Album::withCount('images')->orderBy('order')->get(),
            'documents' => Media::where('type', 'document')->orderBy('order')->get(),
            'videos' => Media::where('type', 'video')->orderBy('order')->get(),
        ]);
    }

    public function album(Album $album)
    {
        return view('front.media.album', [
            'album' => $album->load('images'),
            'others' => Album::whereKeyNot($album->id)->orderBy('order')->take(6)->get(),
        ]);
    }
}
