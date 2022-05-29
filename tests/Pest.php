<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
use Tests\CreatesApplication;
use Tests\DuskTestCase;
use function Pest\Laravel\actingAs;
use Illuminate\Support\Facades\Bus;
use App\Jobs\CreateOgImageJob;

uses(TestCase::class, CreatesApplication::class, RefreshDatabase::class)
    ->beforeEach(function() {
        Bus::fake(CreateOgImageJob::class);
    })
    ->in('Unit', 'Feature');
uses(DuskTestCase::class)->in('Browser');

function login(User $user = null)
{
    actingAs($user ?? User::factory()->admin()->create());
}

function createRequest($method, $uri): Request
{
    $symfonyRequest = SymfonyRequest::create(
        $uri,
        $method,
    );

    return Request::createFromBase($symfonyRequest);
}

function getFeed(string $title = 'test'): string
{
    return  <<<XML
       <feed xmlns="http://www.w3.org/2005/Atom">
           <id>https://example.com/rss</id>
           <link href="https://example.com/rss"/>
           <title><![CDATA[ https://example.com ]]></title>
           <updated>2021-08-11T11:00:30+00:00</updated>

           <entry>
               <title><![CDATA[$title]]></title>

               <link rel="alternate" href="https://example.com/blog/test"/>

               <id>https://example.com</id>

               <author>
                   <name><![CDATA[ Brent Roose ]]></name>
               </author>

               <summary type="html"><![CDATA[$title]]></summary>

               <updated>2021-07-29T00:00:00+00:00</updated>
           </entry>

           <entry>
               <title><![CDATA[$title]]></title>

               <link rel="alternate" href="https://example.com"/>

               <id>https://example.com</id>

               <author>
                   <name><![CDATA[ Brent Roose ]]></name>
               </author>

               <summary type="html"><![CDATA[$title]]></summary>

               <updated>2021-07-29T00:00:00+00:00</updated>
           </entry>
       </feed>
       XML;
}

expect()->extend('isForbidden', function() {
    return expect($this->value->isForbidden())->toBeTrue();
});

expect()->extend('isSuccessfulOrRedirect', function() {
    return expect($this->value->status())->toBeIn([200, 301, 302]);
});

expect()->extend('toBeInTheRange', function(int $min, int $max) {
    return $this
        ->toBeGreaterThanOrEqual($min)
        ->toBeLessThanOrEqual($max);
});

