<?php

namespace Database\Seeders;

use App\Models\Excuse;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ExcuseSeeder extends Seeder
{
    public function run()
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {
            Excuse::create([
                'employee_id' => $employee->id,
                'date_start' => now()->subDays(rand(1, 5)),
                'date_end' => now(),
                'type' => 'Sick',
                'status' => 'pending',
                'description' => 'Flu dan demam',
                'document' => json_encode(['file' => Str::random(10) . '.pdf']),
            ]);
        }
    }
}
