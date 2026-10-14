<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\TeamMember;

class AboutController extends Controller
{
    public function index()
    {
        return view('front.about.index', [
            'page' => Page::published()->where('slug', 'a-propos')->first(),
            'history' => Page::published()->where('slug', 'notre-histoire')->first(),
            'mission' => Page::published()->where('slug', 'mission-vision-valeurs')->first(),
            'members' => TeamMember::active()->get()->groupBy('group'),
        ]);
    }

    public function history()
    {
        return redirect(route('about.index').'#histoire');
    }

    public function mission()
    {
        return redirect(route('about.index').'#mission');
    }

    public function organisation()
    {
        return redirect(route('about.index').'#organisation');
    }
}
