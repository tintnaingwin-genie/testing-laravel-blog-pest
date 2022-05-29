<?php

use App\Http\Controllers\BlogPostController;
use App\Models\BlogPost;
use Laravel\Dusk\Browser;

/*
it('can be clicked to increase the votes', function () {
    $post = BlogPost::factory()->create([
        'likes' => 10,
    ]);

    $this->browse(function(Browser $browser) use ($post) {
        $browser
            ->visit(action([BlogPostController::class, 'show'], $post->slug))
            ->screenshot('blog post')
            ->assertSeeIn('@vote-button', 10)

            ->click('@vote-button')
            ->pause(1000)
            ->assertSeeIn('@vote-button', 11);
    });
});*/
