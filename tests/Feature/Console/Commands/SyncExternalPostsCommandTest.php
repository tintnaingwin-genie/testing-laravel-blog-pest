<?php

use App\Console\Commands\SyncExternalPostsCommand;
use App\Models\ExternalPost;
use Symfony\Component\Console\Command\Command;
use Tests\Fakes\RssRepositoryFake;
use function Pest\Laravel\artisan;

beforeEach(function() {
    RssRepositoryFake::setUp();

    $urls = [
        'https://test-a.com',
        'https://test-b.com',
        'https://test-c.com',
    ];

    config()->set('services.external_feeds', $urls);
});

it('can sync external feeds', function() {
    artisan(SyncExternalPostsCommand::class)->assertExitCode(Command::SUCCESS);

    RssRepositoryFake::expectFeedUrlsFetchedCount(3);

    expect(ExternalPost::count())->toBe(3);
});

it('reports progress', function() {
    artisan(SyncExternalPostsCommand::class)
        ->expectsOutput('Fetching 3 feeds')
        ->expectsOutput("\t- https://test-a.com")
        ->expectsOutput('Done')
        ->assertExitCode(Command::SUCCESS);
});
