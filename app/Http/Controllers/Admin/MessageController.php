<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    use HandlesUploads;

    public function index(Request $request)
    {
        return view('admin.messages.index', [
            'messages' => ContactMessage::when($request->filled('filtre') && $request->query('filtre') === 'non_lus', fn ($q) => $q->unread())
                ->latest()
                ->paginate(20),
            'unread' => ContactMessage::unread()->count(),
        ]);
    }

    public function show(ContactMessage $message)
    {
        $message->update(['is_read' => true]);

        return view('admin.messages.show', compact('message'));
    }

    public function destroy(ContactMessage $message)
    {
        $this->deleteFile($message->attachment);
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'Message supprimé.');
    }
}
