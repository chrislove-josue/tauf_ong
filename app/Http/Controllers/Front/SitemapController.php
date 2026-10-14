<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Page;
use App\Models\Post;
use App\Models\Program;
use App\Models\Project;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = collect()
            ->push(['loc' => route('home'), 'priority' => '1.0'])
            ->push(['loc' => route('about.index'), 'priority' => '0.8'])
            ->push(['loc' => route('programs.index'), 'priority' => '0.8'])
            ->push(['loc' => route('projects.index'), 'priority' => '0.8'])
            ->push(['loc' => route('posts.index'), 'priority' => '0.8'])
            ->push(['loc' => route('events.index'), 'priority' => '0.7'])
            ->push(['loc' => route('media.index'), 'priority' => '0.6'])
            ->push(['loc' => route('contact'), 'priority' => '0.7']);

        Post::published()->get()->each(fn ($p) => $urls->push([
            'loc' => route('posts.show', $p), 'lastmod' => $p->updated_at->toAtomString(), 'priority' => '0.7',
        ]));

        Program::published()->get()->each(fn ($p) => $urls->push([
            'loc' => route('programs.show', $p), 'lastmod' => $p->updated_at->toAtomString(), 'priority' => '0.7',
        ]));

        Project::published()->get()->each(fn ($p) => $urls->push([
            'loc' => route('projects.show', $p), 'lastmod' => $p->updated_at->toAtomString(), 'priority' => '0.6',
        ]));

        Event::published()->get()->each(fn ($p) => $urls->push([
            'loc' => route('events.show', $p), 'lastmod' => $p->updated_at->toAtomString(), 'priority' => '0.6',
        ]));

        Page::published()->get()->each(fn ($p) => $urls->push([
            'loc' => route('pages.show', $p), 'lastmod' => $p->updated_at->toAtomString(), 'priority' => '0.5',
        ]));

        return response()
            ->view('front.sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');
    }

    public function robots()
    {
        $content = "User-agent: *\nAllow: /\nDisallow: /admin\n\nSitemap: ".route('sitemap')."\n";

        return response($content)->header('Content-Type', 'text/plain');
    }
}
