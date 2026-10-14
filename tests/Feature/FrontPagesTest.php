<?php

namespace Tests\Feature;

use App\Models\Album;
use App\Models\Event;
use App\Models\Page;
use App\Models\Post;
use App\Models\Program;
use App\Models\Project;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class FrontPagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
    }

    /**
     * @param  non-empty-string  $route
     */
    #[DataProvider('staticRoutes')]
    public function test_static_front_pages_render(string $route): void
    {
        $this->get(route($route))->assertOk();
    }

    public function test_detail_pages_render(): void
    {
        $routes = [
            [route('programs.show', Program::first()), ],
            [route('projects.show', Project::first())],
            [route('posts.show', Post::first())],
            [route('events.show', Event::first())],
            [route('media.album', Album::first())],
            [route('pages.show', Page::first())],
        ];

        foreach ($routes as [$url]) {
            $this->get($url)->assertOk();
        }
    }

    public function test_events_index_redirects_to_merged_page(): void
    {
        $this->get(route('events.index'))->assertRedirect(route('posts.index'));
    }

    public function test_media_index_redirects_to_merged_page(): void
    {
        $this->get(route('media.index'))->assertRedirect(route('projects.index'));
    }

    public function test_legacy_about_urls_redirect_to_page_sections(): void
    {
        $this->get(route('about.history'))->assertRedirect(route('about.index').'#histoire');
        $this->get(route('about.mission'))->assertRedirect(route('about.index').'#mission');
        $this->get(route('about.organisation'))->assertRedirect(route('about.index').'#organisation');
    }

    public function test_unknown_slug_returns_404(): void
    {
        $this->get('/programmes/slug-inexistant')->assertNotFound();
    }

    public function test_viewing_content_increments_views(): void
    {
        $cases = [
            ['programs.show', Program::first()],
            ['projects.show', Project::first()],
            ['posts.show', Post::first()],
            ['events.show', Event::first()],
            ['media.album', Album::first()],
        ];

        foreach ($cases as [$route, $model]) {
            $before = $model->views;

            $this->get(route($route, $model))->assertOk();

            $this->assertSame($before + 1, $model->fresh()->views, "Views not incremented for [{$route}]");
        }
    }

    public static function staticRoutes(): array
    {
        return array_map(fn ($r) => [$r], [
            'home',
            'about.index',
            'programs.index',
            'projects.index',
            'posts.index',
            'contact',
            'support',
            'join',
            'legal',
            'privacy',
            'faq',
            'sitemap',
            'robots',
        ]);
    }
}
