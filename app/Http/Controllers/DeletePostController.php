<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;

class DeletePostController
{
    public function __invoke(BlogPost $post)
    {
        $post->delete();

        error("Post deleted");

        return redirect()->action([BlogPostAdminController::class, 'index']);
    }
}
