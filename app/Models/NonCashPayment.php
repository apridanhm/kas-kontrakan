<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NonCashPayment extends Model
{
    protected $fillable = [
        'user_id','category_id','amount','proof','status','approved_at'
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function category() { return $this->belongsTo(Category::class); }
}
