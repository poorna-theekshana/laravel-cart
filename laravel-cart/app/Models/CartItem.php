<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'pdct_qty',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
