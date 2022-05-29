<?php

namespace Database\Factories;

use App\Models\BlogPostLike;
use App\Models\Enums\BlogPostStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

class BlogPostLikeFactory extends Factory
{
    protected $model = BlogPostLike::class;

    public function definition(): array
    {
        return [
            'liker_uuid' => (string) Uuid::uuid4(),
        ];
    }
}
