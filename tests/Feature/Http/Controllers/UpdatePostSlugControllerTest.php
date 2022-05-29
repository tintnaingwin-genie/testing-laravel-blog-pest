<?php

use App\Http\Controllers\UpdatePostSlugController;
use App\Models\BlogPost;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;
use App\Models\Redirect;

it('can update the slug of a post', function () {
    login();

    $post = BlogPost::factory()->create([
        'slug' => 'slug-a'
    ]);

    post(action(UpdatePostSlugController::class, $post->slug), [
        'slug' => 'slug-b',
    ])->assertSuccessful();

    assertDatabaseHas(Redirect::class, [
        'from' => '/blog/slug-a',
        'to' => '/blog/slug-b',
    ]);

    expect($post->refresh()->slug)->toEqual('slug-b');
});
