<?php

namespace Database\Seeders;

use App\Models\Family;
use Illuminate\Database\Seeder;

class FamiliesSeeder extends Seeder
{
    public function run(): void
    {
        Family::insert([
            ['name' => 'Quintana López'],
        ]);
    }
}
