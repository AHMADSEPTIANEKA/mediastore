<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laptop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'brand',
        'price',
        'processor',
        'ram',
        'storage',
        'screen_size',
        'battery_life',
        'picture',
    ];
} 