<?php

// database/factories/EmployeeFactory.php

namespace Database\Factories;

use App\Enums\Gender;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition(): array
    {
        return [
            'nik' => $this->faker->unique()->numerify('##############'),
            'email' => $this->faker->unique()->safeEmail,
            'username' => $this->faker->unique()->userName,
            'password' => bcrypt('password'), // gunakan hash
            'fullname' => $this->faker->name,
            'birthplace' => $this->faker->city,
            'birthdate' => $this->faker->date(),
            'photos' => json_encode(['profile' => 'default.jpg']),
            'gender' => $this->faker->randomElement([Gender::MALE->value, Gender::FEMALE->value]),
            'address' => $this->faker->address,
        ];
    }
}
