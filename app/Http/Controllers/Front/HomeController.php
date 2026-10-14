<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Partner;
use App\Models\Post;
use App\Models\Program;
use App\Models\Project;
use App\Models\Slide;
use App\Models\Stat;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        return view('front.home', [
            'slides' => Slide::active()->get(),
            'stats' => Stat::active()->get(),
            'programs' => Program::published()->orderBy('order')->take(6)->get(),
            'projects' => Project::published()->latest()->take(3)->get(),
            'posts' => Post::published()->with('category')->latest('published_at')->take(4)->get(),
            'events' => Event::published()->upcoming()->take(3)->get(),
            'testimonials' => Testimonial::active()->get(),
            'partners' => Partner::active()->get(),
        ]);
    }
}
