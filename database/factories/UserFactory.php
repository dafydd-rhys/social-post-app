<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'role' => $this->faker->randomElement(['basic', 'moderator', 'admin']),
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'email_verified_at' => null,
            'password' => bcrypt($this->faker->password()),
            'remember_token' => "",
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
