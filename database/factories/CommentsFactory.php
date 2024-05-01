<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\WebsitePosts;
use App\Models\Comments;

class CommentsFactory extends Factory
{
    
    protected $model = Comments::class;

    public function definition()
    {
        $commentableType = $this->faker->randomElement([WebsitePosts::class, User::class]);

        return [
            'user_id' => User::factory()->create()->id,
            'content' => $this->faker->paragraph(),
            'commentable_id' => $commentableType::factory()->create()->id,
            'commentable_type' => $commentableType,
        ];
    }
}
