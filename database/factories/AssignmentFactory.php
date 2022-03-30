<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\Asset;

class AssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::factory()->create();
        $asset = Asset::factory()->create();
        return [
            'assignment_date' => $this->faker->date(),
            'assigned_by' => $user->id,
            'asset_id' => $asset->id
        ];
    }
}
