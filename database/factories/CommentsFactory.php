<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\WebsitePosts;
use App\Models\Comments;

class CommentsFactory extends Factory
{
    
    protected $model = Comments::class;

    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'website_posts_id' => WebsitePosts::inRandomOrder()->first()->id,
            'content' => $this->faker->paragraph(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
