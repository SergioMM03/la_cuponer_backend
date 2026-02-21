<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::insert([
            ['name' => 'Restaurantes'],
            ['name' => 'Cuidado Personal'],
            ['name' => 'Entretenimiento'],
            ['name' => 'Supermercados'],
            ['name' => 'Hoteles']
        ]);
    }
}