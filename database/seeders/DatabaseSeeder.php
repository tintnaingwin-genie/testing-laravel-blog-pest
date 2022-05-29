<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\BlogPostFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
         User::factory(1)->create([
             'name' => 'User',
             'email' => 'user@example.com',
             'is_admin' => true,
         ]);

        $files = scandir(__DIR__ . '/blogPosts');

        foreach ($files as $file) {
            if (in_array($file, ['.', '..'])) {
                continue;
            }

            preg_match('/[\d]{4}-[\d]{2}-[\d]{2}/', $file, $matches);

            $date = $matches[0];

            BlogPostFactory::new([
                'author' => 'Brent',
                'title' => ucfirst(str_replace(["{$date}-", '-', '.md'], ['', ' ', ''], $file)),
                'body' => file_get_contents(__DIR__ . "/blogPosts/{$file}"),
                'date' => $date,
            ])->create();
        }
    }
}
