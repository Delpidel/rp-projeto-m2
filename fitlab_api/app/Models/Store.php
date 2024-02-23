<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'fantasy_name',
        'cnpj',
        'email',
        'contact',
        'city',
        'neighborhood',
        'number',
        'street',
        'state',
        'cep',
    ];
}
