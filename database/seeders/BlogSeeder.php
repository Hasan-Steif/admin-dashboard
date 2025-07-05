<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $author = User::firstOrCreate(
            ['email' => 'author@example.com'],
            ['name' => 'Author User', 'password' => bcrypt('password')]
        );

        $categories = collect(['Technology', 'Health', 'Travel', 'Education', 'Business'])->map(function ($name) {
            return Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        });

        $categories->each(function ($category) use ($author) {
            for ($i = 1; $i <= 3; $i++) {
                $imageFileName = strtolower($category->slug) . $i . '.png'; 

                Post::create([
                    'user_id' => $author->id,
                    'category_id' => $category->id,
                    'title' => "$category->name Post $i",
                    'slug' => Str::slug("$category->name Post $i"),
                    'description' => "This is a sample description for $category->name Post $i.",
                    'body' => "This is the full body content for $category->name Post $i.",
                    'image' => 'posts/' . $imageFileName, 
                    'views' => rand(0, 100),
                    'is_published' => true,
                ]);
            }
        });
    }
}
