<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Table>
 */
class TableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name"=>"Table ".fake()->randomNumber(1, 100),
            "guest_number"=> fake()->randomNumber(1),
            "status"=> "available",
            "location"=> "inside"
        ];
    }
}
