<?php

use function Pest\Laravel\get;
use App\Models\Redirect;
use App\Http\Middleware\RedirectMiddleware;

it('will perform the right redirects', function() {
    Route::get('my-test-route', fn() => 'ok')->middleware(RedirectMiddleware::class);

    get('my-test-route')->assertStatus(200);

    Redirect::factory()->create([
        'from' => '/my-test-route',
        'to' => '/new-homepage'
    ]);

    get('my-test-route')->assertRedirect('/new-homepage');
});
