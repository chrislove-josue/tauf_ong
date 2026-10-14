<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    use HandlesUploads;

    public function index()
    {
        return view('admin.albums.index', [
            'albums' => Album::withCount('media')->orderBy('order')->paginate(20),
        ]);
    }

    public function create()
    {
        return view('admin.albums.form', ['album' => new Album()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['cover'] = $this->storeFile($request->file('cover'), 'albums');

        Album::create($data);

        return redirect()->route('admin.albums.index')->with('success', 'Album créé.');
    }

    public function edit(Album $album)
    {
        return view('admin.albums.form', compact('album'));
    }

    public function update(Request $request, Album $album)
    {
        $data = $this->validated($request);

        if ($request->hasFile('cover')) {
            $this->deleteFile($album->cover);
            $data['cover'] = $this->storeFile($request->file('cover'), 'albums');
        }

        $album->update($data);

        return redirect()->route('admin.albums.index')->with('success', 'Album mis à jour.');
    }

    public function destroy(Album $album)
    {
        $this->deleteFile($album->cover);
        $album->delete();

        return back()->with('success', 'Album supprimé.');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'slug' => ['nullable', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'order' => ['nullable', 'integer'],
            'cover' => ['nullable', 'image', 'max:4096'],
        ]);
    }
}
