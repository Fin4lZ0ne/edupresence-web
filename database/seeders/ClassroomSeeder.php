<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    public function run()
    {
        Classroom::insert([
            ['name' => 'X IPA 1'],
            ['name' => 'X IPA 2'],
            ['name' => 'XI IPS 1'],
        ]);
    }
}
