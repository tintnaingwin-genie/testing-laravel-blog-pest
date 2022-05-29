<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlogPostLike extends Model
{
    use HasFactory;

    public $guarded = [];

    public function blogPost(): BelongsTo
    {
        return $this->belongsTo(BlogPost::class);
    }
}

