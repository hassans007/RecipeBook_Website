<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MacroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('macros')->insert([
            // 1) Greek Salad
            [
                'calories'      => 200,
                'protein'       => 7,
                'fat'           => 14,
                'carbohydrates' => 10,
            ],
            // 2) Apple Pie
            [
                'calories'      => 350,
                'protein'       => 4,
                'fat'           => 16,
                'carbohydrates' => 50,
            ],
            // 3) Chicken Tacos
            [
                'calories'      => 300,
                'protein'       => 20,
                'fat'           => 10,
                'carbohydrates' => 35,
            ],
            // 4) French Fries
            [
                'calories'      => 350,
                'protein'       => 5,
                'fat'           => 20,
                'carbohydrates' => 40,
            ],
            // 5) Garlic Bread
            [
                'calories'      => 200,
                'protein'       => 5,
                'fat'           => 8,
                'carbohydrates' => 28,
            ],
            // 6) Vegetable Stir-fry
            [
                'calories'      => 180,
                'protein'       => 6,
                'fat'           => 8,
                'carbohydrates' => 22,
            ],
            // 7) Beef Stroganoff
            [
                'calories'      => 400,
                'protein'       => 25,
                'fat'           => 20,
                'carbohydrates' => 30,
            ],
            // 8) Vegetarian Pizza
            [
                'calories'      => 350,
                'protein'       => 15,
                'fat'           => 12,
                'carbohydrates' => 45,
            ],
            // 9) Shrimp Scampi
            [
                'calories'      => 320,
                'protein'       => 20,
                'fat'           => 12,
                'carbohydrates' => 30,
            ],
            // 10) Pancakes
            [
                'calories'      => 280,
                'protein'       => 7,
                'fat'           => 10,
                'carbohydrates' => 40,
            ],
            // 11) Chicken Alfredo
            [
                'calories'      => 450,
                'protein'       => 30,
                'fat'           => 20,
                'carbohydrates' => 40,
            ],
            // 12) Caesar Salad
            [
                'calories'      => 220,
                'protein'       => 10,
                'fat'           => 15,
                'carbohydrates' => 10,
            ],
            // 13) Tom Yum Soup
            [
                'calories'      => 150,
                'protein'       => 8,
                'fat'           => 4,
                'carbohydrates' => 20,
            ],
            // 14) Butter Chicken
            [
                'calories'      => 400,
                'protein'       => 25,
                'fat'           => 20,
                'carbohydrates' => 30,
            ],
            // 15) Pad Thai
            [
                'calories'      => 420,
                'protein'       => 18,
                'fat'           => 15,
                'carbohydrates' => 50,
            ],
            // 16) Ratatouille
            [
                'calories'      => 120,
                'protein'       => 4,
                'fat'           => 6,
                'carbohydrates' => 12,
            ],
            // 17) Tiramisu
            [
                'calories'      => 300,
                'protein'       => 5,
                'fat'           => 15,
                'carbohydrates' => 35,
            ],
            // 18) Gulab Jamun
            [
                'calories'      => 250,
                'protein'       => 4,
                'fat'           => 8,
                'carbohydrates' => 38,
            ],
            // 19) Shepherd’s Pie
            [
                'calories'      => 380,
                'protein'       => 20,
                'fat'           => 15,
                'carbohydrates' => 40,
            ],
            // 20) Falafel
            [
                'calories'      => 280,
                'protein'       => 12,
                'fat'           => 10,
                'carbohydrates' => 35,
            ],
            // 21) Shakshuka
            [
                'calories'      => 180,
                'protein'       => 10,
                'fat'           => 12,
                'carbohydrates' => 10,
            ],
            // 22) Rogan Josh
            [
                'calories'      => 350,
                'protein'       => 25,
                'fat'           => 15,
                'carbohydrates' => 20,
            ],
            // 23) Paella Valenciana
            [
                'calories'      => 400,
                'protein'       => 20,
                'fat'           => 15,
                'carbohydrates' => 45,
            ],
            // 24) Okonomiyaki
            [
                'calories'      => 300,
                'protein'       => 12,
                'fat'           => 10,
                'carbohydrates' => 40,
            ],
            // 25) Moussaka
            [
                'calories'      => 320,
                'protein'       => 15,
                'fat'           => 18,
                'carbohydrates' => 25,
            ],
            // 26) Empanadas
            [
                'calories'      => 280,
                'protein'       => 10,
                'fat'           => 14,
                'carbohydrates' => 30,
            ],
            // 27) Chili Con Carne
            [
                'calories'      => 350,
                'protein'       => 25,
                'fat'           => 10,
                'carbohydrates' => 30,
            ],
            // 28) Baklava
            [
                'calories'      => 450,
                'protein'       => 6,
                'fat'           => 25,
                'carbohydrates' => 50,
            ],
            // 29) Pho
            [
                'calories'      => 320,
                'protein'       => 20,
                'fat'           => 8,
                'carbohydrates' => 45,
            ],
            // 30) Ceviche
            [
                'calories'      => 150,
                'protein'       => 20,
                'fat'           => 2,
                'carbohydrates' => 5,
            ],
        ]);
    }
}
