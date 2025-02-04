<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\Providers\CpfProvider;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $this->faker->addProvider(new CpfProvider($this->faker));

        return [
            'nome'    => $this->faker->name,
            'cpf'     => $this->faker->unique()->cpf,
            'celular' => $this->faker->phoneNumber,
        ];
    }
}
