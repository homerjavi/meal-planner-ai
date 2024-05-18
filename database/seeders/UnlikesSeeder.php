<?php

namespace Database\Seeders;

use App\Models\Unlike;
use App\Models\User;
use Illuminate\Database\Seeder;

class UnlikesSeeder extends Seeder
{
    public function run(): void
    {
        $userId = User::first()->id;
        
        Unlike::insert([
            ['user_id' => $userId, 'name' => 'Judías'], 
            ['user_id' => $userId, 'name' => 'Roquefort'], 
            ['user_id' => $userId, 'name' => 'Aceitunas'],
        ]);
    }
}
