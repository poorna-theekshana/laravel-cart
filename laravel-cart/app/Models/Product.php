<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'pdct_name',
        'pdct_description',
        'pdct_price',
        'pdct_qty',
    ];
}
