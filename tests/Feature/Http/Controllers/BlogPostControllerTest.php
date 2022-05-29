<?php

use App\Models\BlogPost;

it('can render the homepage')
    ->get('/')
    ->assertSee('My Blog');

it('will only show published blogposts', function () {
    $publishedBlogPost = BlogPost::factory()->published()->create();

    $draftBlogPost = BlogPost::factory()->draft()->create();

    $this
        ->get('/')
        ->assertSee($publishedBlogPost->title)
        ->assertDontSee($draftBlogPost->title);
});
