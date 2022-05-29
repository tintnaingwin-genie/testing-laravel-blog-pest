<?php

namespace Tests\Factories;

use App\Models\BlogPost;
use Carbon\Carbon;

class BlogPostRequestDataFactory
{
    protected string $title = 'Title';
    protected string $author = 'Author';
    protected string $body = 'Body';
    protected string $date = '2021-01-01';

    public static function new()
    {
        return new self();
    }

    public function withTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function withDate(string|Carbon $date): self
    {
        if ($date instanceof Carbon) {
            $date = $date->format('Y-m-d');
        }

        $this->date = $date;

        return $this;
    }

    public function withPost(BlogPost $post): self
    {
        $this->title = $post->title;
        $this->author = $post->author;
        $this->body = $post->body;
        $this->date = $post->date->format('Y-m-d');

        return $this;
    }

    public function create(array $extra = []): array
    {
        return $extra + [
            'title' => $this->title,
            'author' => $this->author,
            'body' => $this->body,
            'date' => $this->date,
        ];
    }
}
