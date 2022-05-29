<?php

namespace App\Providers;

use App\Support\Markdown\HeadingRenderer;
use App\Support\Markdown\HighlightCodeBlockRenderer;
use App\Support\Markdown\HighlightInlineCodeRenderer;
use App\Support\Markdown\LinkRenderer;
use Illuminate\Support\ServiceProvider;
use League\CommonMark\Block\Element\FencedCode;
use League\CommonMark\Block\Element\Heading;
use League\CommonMark\Block\Element\IndentedCode;
use League\CommonMark\Environment;
use League\CommonMark\GithubFlavoredMarkdownConverter;
use League\CommonMark\Inline\Element\Code;
use League\CommonMark\Inline\Element\Link;
use League\CommonMark\MarkdownConverter;
use Spatie\CommonMarkHighlighter\IndentedCodeRenderer;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

        $this->app->singleton(MarkdownConverter::class, function () {
            $environment = Environment::createCommonMarkEnvironment();

            $environment
                ->addInlineRenderer(Link::class, new LinkRenderer())
                ->addInlineRenderer(Code::class, new HighlightInlineCodeRenderer())
                ->addBlockRenderer(FencedCode::class, new HighlightCodeBlockRenderer())
                ->addBlockRenderer(Heading::class, new HeadingRenderer())
                ->addBlockRenderer(FencedCode::class, new HighlightCodeBlockRenderer())
                ->addBlockRenderer(IndentedCode::class, new IndentedCodeRenderer());

            return new GithubFlavoredMarkdownConverter([], $environment);
        });
    }

    public function boot()
    {
    }
}
