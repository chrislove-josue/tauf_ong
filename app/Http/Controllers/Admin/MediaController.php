<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    use HandlesUploads;

    public function index(Request $request)
    {
        return view('admin.media.index', [
            'media' => Media::with('album')
                ->when($request->filled('album'), fn ($q) => $q->where('album_id', $request->query('album')))
                ->when($request->filled('type'), fn ($q) => $q->where('type', $request->query('type')))
                ->latest()
                ->paginate(24),
            'albums' => Album::orderBy('name')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.media.form', [
            'medium' => new Media(),
            'albums' => Album::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'files' => ['required', 'array'],
            'files.*' => ['file', 'max:20480'],
            'album_id' => ['nullable', 'exists:albums,id'],
            'type' => ['required', 'in:image,video,document'],
        ]);

        foreach ($request->file('files') as $file) {
            $path = $this->storeFile($file, 'media');
            $mime = $file->getClientMimeType();

            Media::create([
                'album_id' => $request->input('album_id'),
                'title' => Str::title(str_replace(['-', '_'], ' ', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))),
                'file_path' => $path,
                'type' => $request->input('type'),
                'mime' => $mime,
                'size' => $file->getSize(),
            ]);
        }

        return redirect()->route('admin.media.index')->with('success', 'Média(s) téléversé(s).');
    }

    public function edit(Media $medium)
    {
        return view('admin.media.form', [
            'medium' => $medium,
            'albums' => Album::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Media $medium)
    {
        $data = $request->validate([
            'title' => ['nullable', 'string', 'max:200'],
            'alt' => ['nullable', 'string', 'max:200'],
            'album_id' => ['nullable', 'exists:albums,id'],
            'type' => ['required', 'in:image,video,document'],
            'url' => ['nullable', 'string', 'max:255'],
            'order' => ['nullable', 'integer'],
        ]);

        $medium->update($data);

        return redirect()->route('admin.media.index')->with('success', 'Média mis à jour.');
    }

    public function destroy(Media $medium)
    {
        $this->deleteFile($medium->file_path);
        $medium->delete();

        return back()->with('success', 'Média supprimé.');
    }
}
