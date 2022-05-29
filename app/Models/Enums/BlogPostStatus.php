<?php

namespace App\Models\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self DRAFT()
 * @method static self PUBLISHED()
 */
class BlogPostStatus extends Enum
{
    public function label(): string
    {
        return match($this->value) {
            self::DRAFT()->value => 'draft',
            self::PUBLISHED()->value => 'published',
        };
    }

    public function color(): string
    {
        return match($this->value) {
            self::DRAFT()->value => 'bg-red-500',
            self::PUBLISHED()->value => 'bg-green-500',
        };
    }
}
