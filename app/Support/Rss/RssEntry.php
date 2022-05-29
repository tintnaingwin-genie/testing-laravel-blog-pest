<?php

namespace App\Support\Rss;

use Carbon\CarbonImmutable;
use DateTimeImmutable;

class RssEntry
{
    public function __construct(
        public string $url,
        public string $title,
        public DateTimeImmutable $date,
    ) {
    }

    public static function fromArray(array $data): self
    {
        $title = $data['title'];

        $title = preg_replace_callback("/(&#[0-9]+;)/", fn ($match) => mb_convert_encoding($match[1], "UTF-8", "HTML-ENTITIES"), $title);

        return new self(
            url: $data['id'] ?? $data['url'],
            title: $title,
            date: CarbonImmutable::make($data['date'] ?? $data['updated'] ?? $data['created']),
        );
    }

    public function getDomain(): string
    {
        return str_replace('www.', '', parse_url($this->url, PHP_URL_HOST));
    }
}
