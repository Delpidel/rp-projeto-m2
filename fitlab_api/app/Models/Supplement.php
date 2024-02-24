<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplement extends Model
{
    use HasFactory;

    protected $fillable = [
        'manufacturer_name',
        'amount',
        'description',
        'price',
        'type',
    ];

    protected $table = 'supplements';

}