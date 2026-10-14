<?php

namespace Tests\Feature;

use App\Models\Album;
use App\Models\Category;
use App\Models\Event;
use App\Models\Media;
use App\Models\Page;
use App\Models\Partner;
use App\Models\Post;
use App\Models\Program;
use App\Models\Project;
use App\Models\Slide;
use App\Models\Stat;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class AdminPagesTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);

        $this->admin = User::where('email', 'admin@ongtauf.org')->firstOrFail();
    }

    public function test_guest_is_redirected_from_admin_dashboard(): void
    {
        $this->get(route('admin.dashboard'))->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_login_and_logout(): void
    {
        $this->post(route('admin.login.post'), [
            'email' => 'admin@ongtauf.org',
            'password' => 'password',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticatedAs($this->admin);

        $this->post(route('admin.logout'))->assertRedirect(route('admin.login'));
        $this->assertGuest();
    }

    public function test_login_fails_with_wrong_password(): void
    {
        $this->post(route('admin.login.post'), [
            'email' => 'admin@ongtauf.org',
            'password' => 'wrong-password',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_inactive_user_cannot_login(): void
    {
        $this->admin->forceFill(['is_active' => false])->save();

        $this->post(route('admin.login.post'), [
            'email' => 'admin@ongtauf.org',
            'password' => 'password',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_editor_can_access_content_but_not_user_management(): void
    {
        $editor = User::where('email', 'editeur@ongtauf.org')->firstOrFail();

        $this->actingAs($editor)->get(route('admin.dashboard'))->assertOk();
        $this->actingAs($editor)->get(route('admin.posts.index'))->assertOk();
        $this->actingAs($editor)->get(route('admin.users.index'))->assertForbidden();
    }

    public function test_admin_can_visit_dashboard(): void
    {
        $this->actingAs($this->admin)->get(route('admin.dashboard'))->assertOk();
    }

    /**
     * @param  non-empty-string  $route
     */
    #[DataProvider('adminIndexRoutes')]
    public function test_admin_index_pages_render(string $route): void
    {
        $this->actingAs($this->admin)->get(route($route))->assertOk();
    }

    /**
     * @param  non-empty-string  $route
     */
    #[DataProvider('adminCreateRoutes')]
    public function test_admin_create_pages_render(string $route): void
    {
        $this->actingAs($this->admin)->get(route($route))->assertOk();
    }

    public function test_admin_edit_pages_render(): void
    {
        $this->actingAs($this->admin);

        $models = [
            'admin.posts.edit' => Post::first(),
            'admin.categories.edit' => Category::first(),
            'admin.programs.edit' => Program::first(),
            'admin.projects.edit' => Project::first(),
            'admin.events.edit' => Event::first(),
            'admin.albums.edit' => Album::first(),
            'admin.media.edit' => Media::first(),
            'admin.partners.edit' => Partner::first(),
            'admin.testimonials.edit' => Testimonial::first(),
            'admin.slides.edit' => Slide::first(),
            'admin.team.edit' => TeamMember::first(),
            'admin.stats.edit' => Stat::first(),
            'admin.pages.edit' => Page::first(),
            'admin.users.edit' => $this->admin,
        ];

        foreach ($models as $route => $model) {
            $this->get(route($route, $model))->assertOk();
        }
    }

    public static function adminIndexRoutes(): array
    {
        return array_map(fn ($r) => [$r], [
            'admin.posts.index',
            'admin.categories.index',
            'admin.programs.index',
            'admin.projects.index',
            'admin.events.index',
            'admin.albums.index',
            'admin.media.index',
            'admin.partners.index',
            'admin.testimonials.index',
            'admin.slides.index',
            'admin.team.index',
            'admin.stats.index',
            'admin.pages.index',
            'admin.messages.index',
            'admin.subscribers.index',
            'admin.settings.index',
            'admin.users.index',
        ]);
    }

    public static function adminCreateRoutes(): array
    {
        return array_map(fn ($r) => [$r], [
            'admin.posts.create',
            'admin.categories.create',
            'admin.programs.create',
            'admin.projects.create',
            'admin.events.create',
            'admin.albums.create',
            'admin.media.create',
            'admin.partners.create',
            'admin.testimonials.create',
            'admin.slides.create',
            'admin.team.create',
            'admin.stats.create',
            'admin.pages.create',
            'admin.users.create',
        ]);
    }
}
