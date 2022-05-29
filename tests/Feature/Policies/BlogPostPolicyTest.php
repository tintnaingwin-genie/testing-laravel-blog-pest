<?php

use App\Http\Controllers\BlogPostAdminController;
use App\Http\Controllers\DeletePostController;
use App\Http\Controllers\UpdatePostSlugController;
use App\Models\BlogPost;
use App\Models\User;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('will allow admin users to manage blog posts', function (Closure $request) {
    $post = BlogPost::factory()->create();

    $admin = User::factory()->admin()->create();

    login($admin);

    /** @var \Illuminate\Testing\TestResponse $response */
    $response = $request($post);

    expect($response)->isSuccessfulOrRedirect();
})->with('requests');

it('will not allow guest users to manage blog posts', function (Closure $request) {
    $post = BlogPost::factory()->create();

    $guest = User::factory()->guest()->create();

    login($guest);

    /** @var \Illuminate\Testing\TestResponse $response */
    $response = $request($post);

    expect($response)->isForbidden();
})->with('requests');

dataset('requests', [
    fn(BlogPost $post) => get(action([BlogPostAdminController::class, 'index'])),
    fn(BlogPost $post) => get(action([BlogPostAdminController::class, 'create'])),
    fn(BlogPost $post) => post(action([BlogPostAdminController::class, 'store'])),
    fn(BlogPost $post) => get(action([BlogPostAdminController::class, 'edit'], $post->slug)),
    fn(BlogPost $post) => post(action([BlogPostAdminController::class, 'update'], $post->slug)),
    fn(BlogPost $post) => post(action([BlogPostAdminController::class, 'publish'], $post->slug)),
    fn(BlogPost $post) => post(action(UpdatePostSlugController::class, $post->slug)),
    fn(BlogPost $post) => post(action(DeletePostController::class, $post->slug)),
]);



