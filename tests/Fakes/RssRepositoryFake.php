<?php

namespace Tests\Fakes;

use App\Support\Rss\RssEntry;
use App\Support\Rss\RssRepository;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use Ramsey\Uuid\Uuid;

class RssRepositoryFake extends RssRepository
{
    private static array $feedUrls = [];

    public static function setUp(): void
    {
        self::$feedUrls = [];

        app()->instance(RssRepository::class, new self());
    }

    public function fetch(string $url): Collection
    {
        self::$feedUrls[] = $url;

        return collect([
            new RssEntry(
                url: 'https://test.com/' . Uuid::uuid4(),
                title: 'test',
                date: CarbonImmutable::make('2021-01-01'),
            ),
        ]);
    }

    public static function expectFeedUrlsFetched(array $feedUrls): void
    {
        expect(self::$feedUrls)->toBe($feedUrls);
    }

    public static function expectFeedUrlsFetchedCount(int $expectedFetchCount): void
    {
        expect(count(self::$feedUrls))->toBe($expectedFetchCount);
    }
}
