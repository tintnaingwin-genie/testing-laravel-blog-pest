<?php

use App\Http\Controllers\Api\BlogPostController;
use App\Models\BlogPost;
use Illuminate\Testing\Fluent\AssertableJson;
use function Pest\Laravel\getJson;

it('can show all blog posts', function () {
    $posts = BlogPost::factory()->count(5)->create();

    getJson(action([BlogPostController::class, 'index']))
        ->assertSuccessful()
        ->assertJson(function(AssertableJson $json) use ($posts) {
            $json
                ->has('data', 5)
                ->has('data.0', function(AssertableJson $json) use ($posts) {
                    $json
                        ->where('id',  $posts[0]->id)
                        ->where('slug', $posts[0]->slug)
                        ->where('date',  $posts[0]->date->toDateTimeLocalString() . '.000000Z')
                        ->whereAllType([
                            'id' => 'integer',
                            'slug' => 'string',
                            'date' => 'string',
                        ])
                        ->etc();
                });
        });
});

it('can show a single blogpost', function () {
    $post = BlogPost::factory()->create();

    getJson(action([BlogPostController::class, 'show'], $post))
        ->assertSuccessful()
        ->assertJsonPath('data.title', $post->title);
});
