<?php

namespace Database\Factories;

use App\Models\Envioramental_impact;
use App\Models\Supplier;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Material>
 */
class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'id_type' => Type::inRandomOrder()->first()->id,
            'id_env_impact' => Envioramental_impact::inRandomOrder()->first()->id,
            'id_supplier' => Supplier::inRandomOrder()->first()->id,
            'cost' => fake()->randomFloat(2, 10, 1000),
        ];
    }
}
