<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
    'rental_id',
    'amount',
    'method',
    'status',
    'paid_at'
];
}
