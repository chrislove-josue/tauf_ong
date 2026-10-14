<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Page;

class SupportController extends Controller
{
    public function index()
    {
        return view('front.support', [
            'page' => Page::published()->where('slug', 'nous-soutenir')->first(),
        ]);
    }

    public function join()
    {
        return view('front.join', [
            'page' => Page::published()->where('slug', 'nous-rejoindre')->first(),
        ]);
    }
}
