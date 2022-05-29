<?php

namespace App\Models;

use App\Models\Enums\ExternalPostStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class ExternalPost extends Model
{
    use HasFactory;

    public $guarded = [];

    protected $casts = [
        'date' => 'datetime',
        'status' => ExternalPostStatus::class
    ];

    public function scopeMostRecent(Builder $builder): void
    {
        $builder
            ->orderByDesc('date')
            ->whereRaw(<<<SQL
                id IN (
                    SELECT max(id) FROM external_posts
                    WHERE status = "ACTIVE"
                    GROUP BY domain
                )
                SQL
            );
    }
}
