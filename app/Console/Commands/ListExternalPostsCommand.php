<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ListExternalPostsCommand extends Command
{
    protected $signature = 'list:externals';

    protected $description = 'List external RSS feeds';

    public function handle()
    {
        $feeds = config('services.external_feeds');

        $this->table(
            ['Feed'],
            array_map(fn (string $url) => [$url], $feeds)
        );
    }
}
