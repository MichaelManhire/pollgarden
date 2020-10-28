<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Gender;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->userName,
            'slug' => function (array $attributes) {
                return Str::of($attributes['name'])->slug();
            },
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'age' => $this->faker->numberBetween(13, 99),
            'gender_id' => function () {
                return Gender::all()->random()->id;
            },
            'country_id' => function () {
                if ($this->faker->boolean()) {
                    return 236;
                }

                return Country::all()->random()->id;
            },
            'state_id' => function (array $attributes) {
                if ($attributes['country_id'] === 236) {
                    return State::all()->random()->id;
                }

                return null;
            },
            'last_online_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'updated_at' => function (array $attributes) {
                return $attributes['created_at'];
            },
        ];
    }
}
