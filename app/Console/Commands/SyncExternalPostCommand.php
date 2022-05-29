<?php

namespace App\Console\Commands;

use App\Actions\SyncExternalPostAction;
use Illuminate\Console\Command;

class SyncExternalPostCommand extends Command
{
    protected $signature = 'sync:external {url}';

    protected $description = 'Sync external RSS feed';

    public function handle(SyncExternalPostAction $sync)
    {
        $url = $this->argument('url');

        $this->comment("Syncing $url");

        $sync($url);

        $this->info('Done');
    }

}
