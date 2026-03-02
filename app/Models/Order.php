<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    // Укажите, какие поля могут быть массово присвоены
    protected $fillable = ['user_id','name','email','items','total','status'];

    // Объедините все касты в одно свойство
    protected $casts = ['items' => 'array', 'total' => 'integer'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}