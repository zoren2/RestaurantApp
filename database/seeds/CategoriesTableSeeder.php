<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category1 = Category::create([
            'name' => 'Starters',
            'image' => 'mushrooms.jpg',
            'display_order' => 1
        ]);
        $category2 = Category::create([
            'name' => 'Salads',
            'image' => 'salad.jpg',
            'display_order' => 2
        ]);
        $category3 = Category::create([
            'name' => 'Entrees',
            'image' => 'burger.jpg',
            'display_order' => 3
        ]);
    }
}
