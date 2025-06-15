<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CuisineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cuisines')->insert([
            [
                'name' => 'Greek',
                'description' => 'Mediterranean cuisine with an emphasis on fresh vegetables, olive oil, and seafood.',
            ],
            [
                'name' => 'American',
                'description' => 'Famous for burgers, hot dogs, barbecue, and various regional comfort foods.',
            ],
            [
                'name' => 'Mexican',
                'description' => 'Known for tacos, burritos, and spicy dishes often featuring chilies and corn.',
            ],
            [
                'name' => 'French',
                'description' => 'Famous for pastries, fine dining, and rich flavors with butter and cream.',
            ],
            [
                'name' => 'Italian',
                'description' => 'Known for pasta, pizza, and other Mediterranean flavors like olive oil and tomatoes.',
            ],
            [
                'name' => 'Chinese',
                'description' => 'Features a wide variety of regional styles, including stir-fries, noodles, and dumplings.',
            ],
            [
                'name' => 'Japanese',
                'description' => 'Renowned for sushi, ramen, and dishes emphasizing freshness and presentation.',
            ],
            [
                'name' => 'Indian',
                'description' => 'Characterized by diverse spices, curries, lentils, and breads like naan and roti.',
            ],
            [
                'name' => 'Thai',
                'description' => 'Known for balancing sweet, sour, spicy, and salty flavors in dishes such as pad thai.',
            ],
            [
                'name' => 'Middle Eastern',
                'description' => 'Includes dishes like hummus, falafel, shawarma, and fragrant rice preparations.',
            ],
            [
                'name' => 'Spanish',
                'description' => 'Famous for tapas, paella, and regional specialties featuring olive oil and seafood.',
            ],
        ]);
    }
}
