<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SubscriberController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.subscribers.index', [
            'subscribers' => Subscriber::when($request->filled('q'), fn ($q) => $q->where('email', 'like', '%'.$request->query('q').'%'))
                ->latest()
                ->paginate(30),
        ]);
    }

    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();

        return back()->with('success', 'Abonné supprimé.');
    }

    public function export(): StreamedResponse
    {
        $filename = 'abonnes-newsletter-'.now()->format('Y-m-d').'.csv';

        return response()->streamDownload(function () {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Nom', 'E-mail', 'Statut', 'Date inscription']);

            Subscriber::orderBy('email')->chunk(200, function ($subscribers) use ($out) {
                foreach ($subscribers as $subscriber) {
                    fputcsv($out, [
                        $subscriber->name,
                        $subscriber->email,
                        $subscriber->is_active ? 'Actif' : 'Inactif',
                        $subscriber->subscribed_at?->format('d/m/Y H:i'),
                    ]);
                }
            });

            fclose($out);
        }, $filename, ['Content-Type' => 'text/csv']);
    }
}
