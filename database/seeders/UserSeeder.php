<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Davart77',
            'email' => 'davidardn10@gmail.com',
            'password' => Hash::make('david123'),
            'email_verified_at' => Carbon::now(),
        ]);
    }
}
