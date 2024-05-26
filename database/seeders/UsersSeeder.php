<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Javi',
            'last_name' => 'Quintana',
            'family_id' => 1,
            'birthday' => '1984-08-26',
            'email' => 'homerjavi@gmail.com',
            'password' => Hash::make('1234'),
        ]);

        User::create([
            'name' => 'Jessi',
            'last_name' => 'López',
            'family_id' => 1,
            'birthday' => '1984-01-26',
            'email' => 'jessiconexion@gmail.com',
            'password' => Hash::make('1234'),
        ]);
    }
}
