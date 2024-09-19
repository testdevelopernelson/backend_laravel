<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;    
    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock'
    ];

    public function scopeOrder($query){
        return $query->orderBy('id', 'DESC');
    }
}
