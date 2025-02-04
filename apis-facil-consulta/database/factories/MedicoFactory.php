<?php

namespace Database\Factories;

use App\Models\Cidade;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MedicoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome'          => $this->faker->name,
            'especialidade' => $this->faker->randomElement(['Cardiologista', 'Dermatologista', 'Endocrinologista', 'Ginecologista', 'Ortopedista', 'Pediatra']),
            'cidade_id'     => Cidade::factory(),
        ];
    }
}
