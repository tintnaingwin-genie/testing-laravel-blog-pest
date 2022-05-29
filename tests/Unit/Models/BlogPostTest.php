<?php

use App\Exceptions\BlogPostCouldNotBePublished;
use App\Jobs\CreateOgImageJob;
use App\Models\BlogPost;
use function Spatie\PestPluginTestTime\testTime;

it('adds a slug when a blog post is created')
    ->expect(fn () => BlogPost::factory()->create(['title' => 'My blogpost']))
    ->slug->toEqual('my-blogpost');

it('can determine if a blogpost is published', function() {
   $publishedBlogPost = BlogPost::factory()->published()->create();
   expect($publishedBlogPost->isPublished())->toBeTrue();

    $draftBlogPost = BlogPost::factory()->draft()->create();
    expect($draftBlogPost->isPublished())->toBeFalse();
});

it('has a scope to retrieve all published blogposts', function() {
    testTime()->freeze();

    $publishedBlogPost = BlogPost::factory()->published()->create(['date' => now()]);
    $draftBlogPost = BlogPost::factory()->draft()->create(['date' => now()]);

    testTime()->subSecond();
    $publishedBlogPosts = BlogPost::wherePublished()->get();
    expect($publishedBlogPosts)->toHaveCount(0);

    testTime()->addSecond();
    $publishedBlogPosts = BlogPost::wherePublished()->get();
    expect($publishedBlogPosts)->toHaveCount(1)
        ->and($publishedBlogPosts[0]->id)->toEqual($publishedBlogPost->id);
});

it('does not allow to publish a post that is already published', function () {
    $post = BlogPost::factory()->published()->create();

    $post->publish();
})->throws(BlogPostCouldNotBePublished::class);

it('can be liked', function () {
    /** @var BlogPost $post */
    $post = BlogPost::factory()->published()->create();

    $post
        ->addLikeBy('a')
        ->addLikeBy('b');

    expect($post->postLikes)
        ->toHaveCount(2)
        ->sequence(
            fn($like) => $like->liker_uuid->toBe('a'),
            fn($like) => $like->liker_uuid->toBe('b')
        );
});

it('will create an og image when a post is created', function () {
    Bus::fake();

    BlogPost::factory()->create();

    Bus::assertDispatched(CreateOgImageJob::class);
});

it('will create an new og image when the title is updated', function () {
    Bus::fake();

    $post = BlogPost::factory()->create();

    Bus::assertDispatched(CreateOgImageJob::class, 1);

    $post->update(['title' => 'new title']);

    Bus::assertDispatched(CreateOgImageJob::class, 2);
});

it('will not create a new og image when other attributes are updated', function () {
    Bus::fake();

    $post = BlogPost::factory()->create();

    Bus::assertDispatched(CreateOgImageJob::class, 1);

    $post->fresh()->update(['body' => 'new body']);

    Bus::assertDispatched(CreateOgImageJob::class, 1);
});
