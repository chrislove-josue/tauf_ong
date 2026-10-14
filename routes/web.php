<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Front;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Front-office
|--------------------------------------------------------------------------
*/
Route::get('/', [Front\HomeController::class, 'index'])->name('home');

Route::get('/a-propos', [Front\AboutController::class, 'index'])->name('about.index');
Route::get('/a-propos/notre-histoire', [Front\AboutController::class, 'history'])->name('about.history');
Route::get('/a-propos/mission-vision-valeurs', [Front\AboutController::class, 'mission'])->name('about.mission');
Route::get('/a-propos/organisation', [Front\AboutController::class, 'organisation'])->name('about.organisation');
Route::get('/a-propos/partenaires', [Front\AboutController::class, 'partners'])->name('about.partners');

Route::get('/programmes', [Front\ProgramController::class, 'index'])->name('programs.index');
Route::get('/programmes/{program}', [Front\ProgramController::class, 'show'])->name('programs.show');

Route::get('/realisations', [Front\ProjectController::class, 'index'])->name('projects.index');
Route::get('/realisations/{project}', [Front\ProjectController::class, 'show'])->name('projects.show');

Route::get('/actualites', [Front\PostController::class, 'index'])->name('posts.index');
Route::get('/actualites/{post}', [Front\PostController::class, 'show'])->name('posts.show');

Route::get('/evenements', [Front\EventController::class, 'index'])->name('events.index');
Route::get('/evenements/{event}', [Front\EventController::class, 'show'])->name('events.show');

Route::get('/mediatheque', [Front\MediaController::class, 'index'])->name('media.index');
Route::get('/mediatheque/albums/{album}', [Front\MediaController::class, 'album'])->name('media.album');

Route::get('/nous-soutenir', [Front\SupportController::class, 'index'])->name('support');
Route::get('/nous-rejoindre', [Front\SupportController::class, 'join'])->name('join');

Route::get('/contact', [Front\ContactController::class, 'show'])->name('contact');
Route::post('/contact', [Front\ContactController::class, 'store'])->name('contact.store')->middleware('throttle:10,1');
Route::post('/newsletter', [Front\NewsletterController::class, 'store'])->name('newsletter.store')->middleware('throttle:10,1');

Route::get('/mentions-legales', [Front\PageController::class, 'legal'])->name('legal');
Route::get('/politique-de-confidentialite', [Front\PageController::class, 'privacy'])->name('privacy');
Route::get('/faq', [Front\PageController::class, 'faq'])->name('faq');

Route::get('/sitemap.xml', [Front\SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', [Front\SitemapController::class, 'robots'])->name('robots');

Route::get('/pages/{page}', [Front\PageController::class, 'show'])->name('pages.show');

/*
|--------------------------------------------------------------------------
| Back-office (CMS)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [Admin\AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [Admin\AuthController::class, 'login'])->name('login.post');
    Route::post('logout', [Admin\AuthController::class, 'logout'])->name('logout');

    Route::middleware('admin')->group(function () {
        Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

        Route::resource('posts', Admin\PostController::class)->except('show');
        Route::resource('categories', Admin\CategoryController::class)->except('show');
        Route::resource('programs', Admin\ProgramController::class)->except('show');
        Route::resource('projects', Admin\ProjectController::class)->except('show');
        Route::resource('events', Admin\EventController::class)->except('show');
        Route::resource('albums', Admin\AlbumController::class)->except('show');
        Route::resource('media', Admin\MediaController::class)->except('show');
        Route::resource('partners', Admin\PartnerController::class)->except('show');
        Route::resource('testimonials', Admin\TestimonialController::class)->except('show');
        Route::resource('slides', Admin\SlideController::class)->except('show');
        Route::resource('team', Admin\TeamController::class)->except('show');
        Route::resource('stats', Admin\StatController::class)->except('show');
        Route::resource('pages', Admin\PageController::class)->except('show');

        Route::get('messages', [Admin\MessageController::class, 'index'])->name('messages.index');
        Route::get('messages/{message}', [Admin\MessageController::class, 'show'])->name('messages.show');
        Route::delete('messages/{message}', [Admin\MessageController::class, 'destroy'])->name('messages.destroy');

        Route::get('subscribers', [Admin\SubscriberController::class, 'index'])->name('subscribers.index');
        Route::delete('subscribers/{subscriber}', [Admin\SubscriberController::class, 'destroy'])->name('subscribers.destroy');
        Route::get('subscribers/export', [Admin\SubscriberController::class, 'export'])->name('subscribers.export');

        Route::get('settings', [Admin\SettingController::class, 'index'])->name('settings.index');
        Route::put('settings', [Admin\SettingController::class, 'update'])->name('settings.update');

        Route::get('profile', [Admin\ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [Admin\ProfileController::class, 'update'])->name('profile.update');

        Route::middleware('superadmin')->group(function () {
            Route::resource('users', Admin\UserController::class)->except('show');
        });
    });
});
