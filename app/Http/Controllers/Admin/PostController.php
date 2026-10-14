<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    use HandlesUploads;

    public function index(Request $request)
    {
        $posts = Post::with('category')
            ->when($request->filled('q'), fn ($q) => $q->where('title', 'like', '%'.$request->query('q').'%'))
            ->when($request->filled('statut'), fn ($q) => $q->where('status', $request->query('statut')))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.form', [
            'post' => new Post(['status' => 'brouillon']),
            'categories' => \App\Models\Category::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['user_id'] = Auth::id();
        $data['cover'] = $this->storeFile($request->file('cover'), 'posts');

        Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Article créé avec succès.');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.form', [
            'post' => $post,
            'categories' => \App\Models\Category::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $data = $this->validated($request, $post);

        if ($request->hasFile('cover')) {
            $this->deleteFile($post->cover);
            $data['cover'] = $this->storeFile($request->file('cover'), 'posts');
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success', 'Article mis à jour.');
    }

    public function destroy(Post $post)
    {
        $this->deleteFile($post->cover);
        $post->delete();

        return back()->with('success', 'Article supprimé.');
    }

    protected function validated(Request $request, ?Post $post = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'slug' => ['nullable', 'string', 'max:200'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'body' => ['nullable', 'string'],
            'status' => ['required', 'in:brouillon,en_attente,publie,archive'],
            'published_at' => ['nullable', 'date'],
            'featured' => ['nullable', 'boolean'],
            'meta_title' => ['nullable', 'string', 'max:200'],
            'meta_description' => ['nullable', 'string', 'max:300'],
            'cover' => ['nullable', 'image', 'max:4096'],
        ]);

        $data['featured'] = $request->boolean('featured');

        if ($data['status'] === 'publie' && blank($data['published_at'] ?? null)) {
            $data['published_at'] = now();
        }

        return $data;
    }
}
