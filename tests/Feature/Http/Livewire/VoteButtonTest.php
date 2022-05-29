<?php

use App\Http\Livewire\VoteButton;
use App\Models\BlogPost;
use Livewire\Livewire;

it('it can toggle a like', function () {
    $post = BlogPost::factory()->create();

    $component = Livewire::test(VoteButton::class, ['post' => $post,]);

    $component->call('like');
    expect($post->refresh()->likes)->toBe(1);

    $otherComponent = Livewire::test(VoteButton::class, ['post' => $post]);
    $otherComponent->call('like');
    expect($post->refresh()->likes)->toBe(2);

    $component->call('like');
    expect($post->refresh()->likes)->toBe(1);

    $otherComponent->call('like');
    expect($post->refresh()->likes)->toBe(0);
});
