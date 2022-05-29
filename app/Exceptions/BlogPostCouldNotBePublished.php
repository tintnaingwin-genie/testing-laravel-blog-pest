<?php

namespace App\Exceptions;

use Exception;

class BlogPostCouldNotBePublished extends Exception
{
    public static function make(): static
    {
        return new static('The blog post was already published');
    }
}
