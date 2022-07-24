<?php

namespace Database\Seeders;

use App\Models\Task1\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Action and Adventure',
            'Classics',
            'Comic Book or Graphic Novel',
            'Detective and Mystery',
            'Fantasy',
            'Historical Fiction',
            'Horror',
            'Literary Fiction'
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
