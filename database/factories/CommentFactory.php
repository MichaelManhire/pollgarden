<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Poll;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => function () {
                return User::all()->random()->id;
            },
            'poll_id' => function () {
                return Poll::all()->random()->id;
            },
            'parent_comment_id' => function (array $attributes) {
                if ($this->faker->boolean()) {
                    $comments = Comment::where('poll_id', $attributes['poll_id'])->get();

                    if ($comments->count()) {
                        return $comments->random()->id;
                    }

                    return null;
                }

                return null;
            },
            'body' => $this->faker->text($this->faker->numberBetween(5, 1000)),
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'updated_at' => function (array $attributes) {
                return $attributes['created_at'];
            },
        ];
    }
}
