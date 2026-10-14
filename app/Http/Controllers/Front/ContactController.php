<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Mail\ContactMessageReceived;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    use HandlesUploads;

    public function show()
    {
        return view('front.contact');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['nullable', 'string', 'max:40'],
            'subject' => ['nullable', 'string', 'max:150'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
            'attachment' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,doc,docx', 'max:5120'],
        ]);

        $data['attachment'] = $this->storeFile($request->file('attachment'), 'messages');
        $data['ip_address'] = $request->ip();

        $message = ContactMessage::create($data);

        try {
            $recipient = tauf_setting('contact_email', config('mail.from.address'));
            Mail::to($recipient)->send(new ContactMessageReceived($message));
        } catch (\Throwable $e) {
            report($e);
        }

        return redirect()->route('contact')->with('success', 'Merci ! Votre message a bien été envoyé. Nous vous répondrons dans les meilleurs délais.');
    }
}
