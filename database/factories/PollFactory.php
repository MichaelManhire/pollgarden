<?php

namespace Database\Factories;

use App\Models\Poll;
use App\Models\PollCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PollFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Poll::class;

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
            'category_id' => function () {
                return PollCategory::all()->random()->id;
            },
            'title' => Str::replaceLast('.', '?', $this->faker->text($this->faker->numberBetween(5, 80))),
            'slug' => function (array $attributes) {
                return Str::of($attributes['title'])->slug() . '-' . rand();
            },
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'updated_at' => function (array $attributes) {
                return $attributes['created_at'];
            },
        ];
    }
}
