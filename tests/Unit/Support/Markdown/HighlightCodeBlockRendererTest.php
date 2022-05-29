<?php

use League\CommonMark\MarkdownConverter;
use function \Spatie\Snapshots\assertMatchesSnapshot;

it('can parse hljs tags', function () {
    $markdown = <<<MD
```php
public function __construct(
    <hljs keyword>public readonly</hljs> <hljs type>string</hljs> <hljs prop>\$title</hljs>,
    <hljs keyword>public readonly</hljs> <hljs type>string</hljs> <hljs prop>\$body</hljs>,
) {}
```
MD;

    $convertor = app(MarkdownConverter::class);

    $html = $convertor->convertToHtml($markdown);

    assertMatchesSnapshot($html);
});
