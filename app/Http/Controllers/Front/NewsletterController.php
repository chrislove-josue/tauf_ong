<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:150'],
        ]);

        $subscriber = Subscriber::firstOrNew(['email' => $data['email']]);
        $subscriber->is_active = true;
        $subscriber->subscribed_at = now();
        $subscriber->save();

        return back()->with('newsletter_success', 'Merci ! Vous êtes désormais inscrit(e) à notre newsletter.');
    }
}
