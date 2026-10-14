<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::published()
            ->with('category')
            ->when($request->filled('categorie'), function ($query) use ($request) {
                $query->whereHas('category', fn ($q) => $q->where('slug', $request->query('categorie')));
            })
            ->when($request->filled('q'), function ($query) use ($request) {
                $term = '%'.$request->query('q').'%';
                $query->where(fn ($q) => $q->where('title', 'like', $term)->orWhere('excerpt', 'like', $term));
            })
            ->latest('published_at')
            ->paginate(9)
            ->withQueryString();

        return view('front.actualites.index', [
            'posts' => $posts,
            'categories' => \App\Models\Category::orderBy('order')->get(),
            'upcoming' => Event::published()->upcoming()->get(),
            'past' => Event::published()->past()->paginate(9),
        ]);
    }

    public function show(Post $post)
    {
        abort_unless($post->status === 'publie', 404);

        $post->recordView();

        return view('front.posts.show', [
            'post' => $post->load('category', 'author'),
            'related' => Post::published()
                ->whereKeyNot($post->id)
                ->when($post->category_id, fn ($q) => $q->where('category_id', $post->category_id))
                ->latest('published_at')
                ->take(3)
                ->get(),
        ]);
    }
}
