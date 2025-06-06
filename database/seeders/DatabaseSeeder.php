<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // UserSeeder::class,
            EmployeeSeeder::class,
            ClassroomSeeder::class,
            SubjectSeeder::class,
            ScheduleSeeder::class,
            ExcuseSeeder::class,
            AttendanceSeeder::class,
        ]);
    }
}
