<?php

namespace App\Actions;

use App\Models\Enums\ExternalPostStatus;
use App\Models\ExternalPost;
use App\Support\Rss\RssEntry;
use App\Support\Rss\RssRepository;

class SyncExternalPostAction
{
    public function __construct(private RssRepository $rss)
    {
    }

    public function __invoke(string $url): void
    {
        $entries = $this->rss
            ->fetch($url)
            ->sortBy(fn (RssEntry $rss) => $rss->date->getTimestamp());

        foreach ($entries as $entry) {
            ExternalPost::updateOrCreate([
                'url' => $entry->url,
            ], [
                'title' => $entry->title,
                'date' => $entry->date,
                'domain' => $entry->getDomain(),
                'status' => ExternalPostStatus::ACTIVE(),
            ]);
        }
    }
}
