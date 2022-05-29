<?php

use App\Http\Controllers\BlogPostAdminController;
use App\Models\BlogPost;
use App\Models\User;
use Tests\Factories\BlogPostRequestDataFactory;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;

beforeEach(function () {
    $this->post = BlogPost::factory()->create();
    $this->requestData = BlogPostRequestDataFactory::new();
});

it('will update a blog post when an admin is logged in', function () {
    $sendRequest = fn() => post(
        action([BlogPostAdminController::class, 'update'], $this->post->slug),
        $this->requestData->withTitle('test')->create(),
    );

    $sendRequest()->assertRedirect(route('login'));

    login();

    $sendRequest();

    expect($this->post->refresh()->title)->toBe('test');
});

it('validates required fields on the post edit form', function () {
    login();

    post(action([BlogPostAdminController::class, 'update'], $this->post->slug), [])
        ->assertSessionHasErrors(['title', 'author', 'body', 'date']);

    post(
        action([BlogPostAdminController::class, 'update'], $this->post->slug),
        $this->requestData->withTitle('test')->create()
    )->assertSessionHasNoErrors();
});

it('will validate the date format on the post edit form', function () {
    login();

    post(
        action([BlogPostAdminController::class, 'update'], $this->post->slug),
        $this->requestData->withDate('01/01/2021')->create(),
    )->assertSessionHasErrors([
        'date' => 'The date does not match the format Y-m-d.'
    ]);
});

it('will update all the attributes of the post model', function() {
    login();

    $requestData = $this->requestData->create();

    post(
        action([BlogPostAdminController::class, 'update'], $this->post->slug),
        $requestData,
    )->assertSessionDoesntHaveErrors();

    $updatedPost = $this->post->refresh();

    expect($updatedPost)
        ->title->toBe($requestData['title'])
        ->author->toBe($requestData['author'])
        ->body->toBe($requestData['body'])
        ->date->format('Y-m-d')->toBe($requestData['date']);
});
