<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Partner;
use App\Models\TeamMember;

class AboutController extends Controller
{
    public function index()
    {
        return view('front.about.index', [
            'page' => Page::published()->where('slug', 'a-propos')->first(),
            'team' => TeamMember::active()->get(),
        ]);
    }

    public function history()
    {
        return view('front.about.history', [
            'page' => Page::published()->where('slug', 'notre-histoire')->first(),
        ]);
    }

    public function mission()
    {
        return view('front.about.mission', [
            'page' => Page::published()->where('slug', 'mission-vision-valeurs')->first(),
        ]);
    }

    public function organisation()
    {
        return view('front.about.organisation', [
            'members' => TeamMember::active()->get()->groupBy('group'),
        ]);
    }

    public function partners()
    {
        return view('front.about.partners', [
            'partners' => Partner::active()->get()->groupBy('category'),
        ]);
    }
}
