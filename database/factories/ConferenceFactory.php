<?php

namespace Database\Factories;

use App\Enums\RegionEnum;
use App\Models\Conference;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConferenceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Conference::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'website' => $this->faker->url(),
            'description' => $this->faker->text(),
            'start_date' => $this->faker->dateTime(),
            'end_date' => $this->faker->dateTime(),
            'is_published' => $this->faker->boolean(),
            'status' => $this->faker->randomElement(['draft', 'published', 'archived']),
            'region' => $this->faker->randomElement(RegionEnum::class),
        ];
    }
}
