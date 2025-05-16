<?php

namespace Database\Seeders;

use App\Models\Schedule;
use App\Models\Employee;
use App\Models\Subject;
use App\Models\Classroom;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    public function run()
    {
        $employees = Employee::all();
        $subjects = Subject::all();
        $classrooms = Classroom::all();

        foreach ($employees as $employee) {
            Schedule::create([
                'employee_id' => $employee->id,
                'subject_id' => $subjects->random()->id,
                'classroom_id' => $classrooms->random()->id,
                'day' => rand(1, 5), // 1 = Monday, 7 = Sunday
                'time_start' => '08:00:00',
                'time_end' => '09:30:00',
            ]);
        }
    }
}
