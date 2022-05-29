<?php

namespace App\Console\Commands;

use App\Jobs\CreateOgImageJob;
use App\Models\BlogPost;
use Illuminate\Console\Command;

class GenerateOgImageCommand extends Command
{
    protected $signature = 'generate:og {post}';

    public function handle()
    {
        $post = BlogPost::find($this->argument('post'));

        dispatch(new CreateOgImageJob($post));

        $this->info($post->ogImageUrl());
    }
}
