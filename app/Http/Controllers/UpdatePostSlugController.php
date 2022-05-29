<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Redirect;
use Illuminate\Http\Request;

class UpdatePostSlugController
{
    public function __invoke(BlogPost $post, Request $request)
    {
        $newSlug = $request->validate([
           'slug' => ['required', 'string'],
        ])['slug'];

        Redirect::createForPost($post->slug, $newSlug);

        $post->update(['slug' => $newSlug]);
    }
}
