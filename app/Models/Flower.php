<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Flower extends Model
{
    use HasFactory;


protected $fillable = ['name', 'price', 'description', 'image_path', 'category_id'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}