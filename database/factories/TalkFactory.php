<?php

namespace Database\Factories;

use App\Enums\TalkLength;
use App\Enums\TalkStatus;
use App\Models\Speaker;
use App\Models\Talk;
use Illuminate\Database\Eloquent\Factories\Factory;

class TalkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Talk::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'abstract' => $this->faker->text(),
            'speaker_id' => Speaker::factory(),
            'new_talk' => $this->faker->boolean(),
            'status' => $this->faker->randomElement(TalkStatus::class),
            'length' => $this->faker->randomElement(TalkLength::class),
        ];
    }
}
