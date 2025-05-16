<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Classroom;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    public function run()
    {
        $employees = Employee::all();
        $classrooms = Classroom::all();
        $subjects = Subject::all();

        foreach ($employees as $employee) {
            Attendance::create([
                'employee_id' => $employee->id,
                'classroom_id' => $classrooms->random()->id,
                'subject_id' => $subjects->random()->id,
                'subject_start' => '08:00:00',
                'subject_end' => '09:30:00',
                'date' => now()->toDateString(),
                'time_start' => '08:05:00',
                'time_end' => '09:30:00',
                'status' => 'present',
            ]);
        }
    }
}
