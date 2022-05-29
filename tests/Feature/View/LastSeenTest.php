<?php

use App\Models\BlogPost;
use function Spatie\PestPluginTestTime\testTime;

it('shows the last seen date', function () {
    $post = BlogPost::factory()->create();

    testTime()->freeze('2021-01-01 00:00:00');

    test()
        ->blade('<x-last-seen :post="$post"/>', ['post' => $post])
        ->assertDontSee('Last seen');

    app(\Illuminate\Http\Request::class)->cookies->set("last_seen_{$post->slug}", now()->toDateTimeString());

    test()
        ->blade('<x-last-seen :post="$post"/>', ['post' => $post])
        ->assertSee('Last seen')
        ->assertSee('2021-01-01');
});
