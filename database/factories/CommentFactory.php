<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'post_id' => Post::factory(),
            'content' => $this->faker->realText($this->faker->numberBetween(100, 750)),
            'commentable_id' => Post::factory(),
            'commentable_type' => $this->commentableType(...),
            'created_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }

    public function commentableType(array $values)
    {
        $type = $values['commentable_id'];
        $modelName = $type instanceof Factory ? $type->model() : $type::class;

        return (new $modelName)->getMorphClass();
    }
}
