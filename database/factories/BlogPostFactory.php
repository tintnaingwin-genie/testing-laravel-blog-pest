<?php

namespace Database\Factories;

use App\Models\BlogPost;
use App\Models\Enums\BlogPostStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogPostFactory extends Factory
{
    protected $model = BlogPost::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'author' => $this->faker->name,
            'date' => $this->faker->dateTimeBetween('-1 year'),
            'body' => $this->faker->sentence,
            'status' => $this->faker->randomElement([
                BlogPostStatus::DRAFT(),
                BlogPostStatus::PUBLISHED(),
            ]),
        ];
    }

    public function published()
    {
        return $this->state([
            'status' =>  BlogPostStatus::PUBLISHED(),
        ]);
    }

    public function draft()
    {
        return $this->state([
            'status' =>  BlogPostStatus::DRAFT(),
        ]);
    }
}
