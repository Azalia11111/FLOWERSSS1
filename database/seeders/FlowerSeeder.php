<?php

namespace Database\Seeders;
use App\Models\Flower;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class FlowerSeeder extends Seeder
{
    public function run()
    {
        Flower::create(['name' => 'Роза 1', 'description' => 'Описание Розы 1', 'image_path' => '1.jpg', 'category_id' => 1]);
        Flower::create(['name' => 'Роза 2', 'description' => 'Описание Розы 2', 'image_path' => '2.jpg', 'category_id' => 1]);        Flower::create(['name' => 'Роза 3', 'description' => 'Описание Розы 3', 'image_path' => '3.jpg', 'category_id' => 1]);
        
        Flower::create(['name' => 'Тюльпан 1', 'description' => 'Описание Тюльпана 1', 'image_path' => '4.jpg', 'category_id' => 2]);
        Flower::create(['name' => 'Тюльпан 2', 'description' => 'Описание Тюльпана 2', 'image_path' => '5.jpg', 'category_id' => 2]);
        Flower::create(['name' => 'Тюльпан 3', 'description' => 'Описание Тюльпана 3', 'image_path' => '6.jpg', 'category_id' => 2]);
        
        Flower::create(['name' => 'Гипсофила 1', 'description' => 'Описание Гипсофилы 1', 'image_path' => '7.jpg', 'category_id' => 3]);
        Flower::create(['name' => 'Гипсофила 2', 'description' => 'Описание Гипсофилы 2', 'image_path' => '8.jpg', 'category_id' => 3]);
        Flower::create(['name' => 'Гипсофила 3', 'description' => 'Описание Гипсофилы 3', 'image_path' => '9.jpg', 'category_id' => 3]);
    }
}
