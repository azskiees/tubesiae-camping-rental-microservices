<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'item_name',
        'category',
        'stock',
        'price_per_day',
        'status'
    ];
}
