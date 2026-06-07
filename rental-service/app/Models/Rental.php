<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Rental extends Model
{
    protected $fillable = [
        'customer_id',
        'item_id',
        'quantity',
        'rental_date',
        'return_date',
        'status'
    ];
}
