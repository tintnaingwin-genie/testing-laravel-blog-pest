<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\BlogPostResource;
use App\Models\BlogPost;

class BlogPostController
{
    public function index()
    {
        return BlogPostResource::collection(BlogPost::all());
    }

    public function show(BlogPost $post)
    {
        return new BlogPostResource($post);
    }
}
