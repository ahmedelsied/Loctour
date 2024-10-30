<?php

namespace Database\Factories\Location;

use App\Domain\Location\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class PlaceFactory extends Factory
{
    protected $model = Place::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => [
                'ar' => $this->faker->company,
                'en' => $this->faker->company
            ],
            'address' => [
                'ar' => $this->faker->address,
                'en' => $this->faker->address
            ],            // Random address
            'latitude' => $this->faker->latitude,          // Random latitude
            'longitude' => $this->faker->longitude,        // Random longitude
            'type' => $this->faker->domainName,        // Random longitude
            'trend' => $this->faker->boolean,
            'description' =>[
                'ar' => $this->faker->paragraph,
                'en' => $this->faker->paragraph
            ],      // Random description
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
