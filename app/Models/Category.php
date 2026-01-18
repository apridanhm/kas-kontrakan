<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'default_amount',
        'is_active',
        'is_cash_based',
    ];
}
