<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run()
    {
        Subject::insert([
            ['name' => 'Matematika', 'max_lateness' => 15],
            ['name' => 'Bahasa Inggris', 'max_lateness' => 10],
            ['name' => 'Fisika', 'max_lateness' => 20],
        ]);
    }
}
