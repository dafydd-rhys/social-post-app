<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\WebsitePosts;

class WebsitePostsFactory extends Factory
{
    protected $model = WebsitePosts::class;

    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
            'image_path' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
