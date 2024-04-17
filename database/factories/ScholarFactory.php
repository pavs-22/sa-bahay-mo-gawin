<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Scholar; // Make sure this matches your model class name exactly.

class ScholarFactory extends Factory
{
    protected $model = Scholar::class; // This should match the name of your model class.

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Scholar_Code' => $this->faker->numerify('CSP-####'),
            'Institution' => $this->faker->company(),
            'Unit' => $this->faker->municipality(),
            'Area' => $this->faker->province(),
            'fullname' => $this->faker->name(),
            'name_of_member' => $this->faker->firstname(),
            'batch' => $this->faker->numberBetween(1, 41), // Assuming batch starts from 1
            'scholarship_type' => 'Regular', // Static value
            'Year_level' => 'GRADE 12', // Static value
            'course' => 'BSIS', // Static value
            'contact' => $this->faker->mobileNumber(),
            'Address' => $this->faker->address(),
            'status' => 'active', // Static value
            'Remarks' => $this->faker->sentence(),
            'account' => true,
        ];
    }
}
