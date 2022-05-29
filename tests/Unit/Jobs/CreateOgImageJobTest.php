<?php

use App\Jobs\CreateOgImageJob;
use App\Models\BlogPost;

it('will create an og image for a blog post', function () {
    Storage::fake('public');

    $post = BlogPost::factory()->create(['slug' => 'my-slug']);

    (new CreateOgImageJob($post))->handle();

    Storage::disk('public')->assertExists("blog/my-slug.png");
});
