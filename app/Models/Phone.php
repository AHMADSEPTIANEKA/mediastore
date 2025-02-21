<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    // Definisikan kolom yang boleh diisi
    protected $fillable = [
        'name',
        'brand',
        'type',
        'price',
        'camera_main',
        'camera_ultra',
        'camera_front',
        'screen_size',
        'screen_resolution',
        'refresh_rate',
        'processor',
        'battery_capacity',
        'charging_speed',
        'ip_rating',
        'picture'
    ];
}
