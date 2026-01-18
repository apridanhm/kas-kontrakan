<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentInstallment extends Model
{
    protected $fillable = [
        'payment_id',
        'amount',
        'proof',
        'paid_at',
        'is_approved',
        'approved_at',
    ];

    // cicilan milik satu payment
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
