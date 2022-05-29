<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\ExternalPost;
use League\CommonMark\MarkdownConverter;

class BlogPostController
{
    public function index()
    {
        $posts = BlogPost::query()
            ->orderByDesc('date')
            ->wherePublished()
            ->paginate(15);

        $recents = ExternalPost::mostRecent()->limit(6)->get();
        return view('blog.index', [
            'posts' => $posts,
            'recents' => $recents,
        ]);
    }

    public function show(BlogPost $post, MarkdownConverter $converter)
    {
        $body = $converter->convertToHtml($post->body);

        return view('blog.show', [
            'post' => $post,
            'body' => $body,
        ]);
    }
}
