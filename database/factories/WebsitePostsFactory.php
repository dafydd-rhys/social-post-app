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
            'content' => $this->faker->paragraph(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
