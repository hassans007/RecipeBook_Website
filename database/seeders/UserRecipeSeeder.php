<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_recipes')->insert([
            [
                'user_id' => 1, 
                'recipe_id' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1, 
                'recipe_id' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1, 
                'recipe_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1, 
                'recipe_id' => 8, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, 
                'recipe_id' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, 
                'recipe_id' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
