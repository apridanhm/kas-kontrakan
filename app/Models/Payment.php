<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'month',
        'year',
        'amount',
        'status',
        'paid_at',
    ];

    // 🔗 RELASI KE USER
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔗 RELASI KE CATEGORY
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // 🔗 CICILAN
    public function installments()
    {
        return $this->hasMany(PaymentInstallment::class);
    }

    public function paidTotal()
    {
        return $this->installments()->sum('amount');
    }

    public function remaining()
    {
        return $this->amount - $this->paidTotal();
    }
}
