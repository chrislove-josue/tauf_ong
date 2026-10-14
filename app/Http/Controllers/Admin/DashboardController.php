<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Event;
use App\Models\Post;
use App\Models\Project;
use App\Models\Subscriber;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'counts' => [
                'posts' => Post::count(),
                'published' => Post::where('status', 'publie')->count(),
                'projects' => Project::count(),
                'events' => Event::count(),
                'messages' => ContactMessage::count(),
                'unread' => ContactMessage::unread()->count(),
                'subscribers' => Subscriber::active()->count(),
            ],
            'latestPosts' => Post::with('category')->latest()->take(5)->get(),
            'latestMessages' => ContactMessage::latest()->take(5)->get(),
            'upcomingEvents' => Event::upcoming()->take(5)->get(),
        ]);
    }
}
