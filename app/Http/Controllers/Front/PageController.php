<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Page;

class PageController extends Controller
{
    public function show(Page $page)
    {
        abort_unless($page->status === 'publie', 404);

        return view('front.page', ['page' => $page]);
    }

    public function legal()
    {
        return view('front.page', [
            'page' => Page::published()->where('slug', 'mentions-legales')->firstOrFail(),
        ]);
    }

    public function privacy()
    {
        return view('front.page', [
            'page' => Page::published()->where('slug', 'politique-de-confidentialite')->firstOrFail(),
        ]);
    }

    public function faq()
    {
        return view('front.faq', [
            'page' => Page::published()->where('slug', 'faq')->first(),
        ]);
    }
}
