<?php

namespace Database\Seeders;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Розы']);
        Category::create(['name' => 'Тюльпаны']);
        Category::create(['name' => 'Гипсофила']);
    }
}