<?php

namespace Database\Seeders;

use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Seeder;

class LikesSeeder extends Seeder
{
    public function run(): void
    {
        $userId = User::first()->id;
        
        Like::insert([
            ['user_id' => $userId, 'name' => 'Pollo empanado'], 
            ['user_id' => $userId, 'name' => 'Pizza'], 
            ['user_id' => $userId, 'name' => 'Aguacate'], 
            ['user_id' => $userId, 'name' => 'Plátano']
        ]);
    }
}
