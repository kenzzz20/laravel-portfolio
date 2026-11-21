<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PresenceController;

Route::view('/', 'welcome')->name('home');

foreach ([
    'projects', 'experience', 'stack', 'certifications', 'recommendations', 'affiliations',
    'shop', 'gear', 'resources', 'collabs', 'consulting', 'blog',
] as $page) {
    Route::view("/$page", $page)->name($page);
}

Route::get('/posts/{slug}', function (string $slug) {
    $post = collect(config('portfolio.posts'))->firstWhere('slug', $slug);
    abort_unless($post, 404);

    return view('post', compact('post'));
})->name('post');

Route::post('/presence', PresenceController::class)->middleware('throttle:6,1');