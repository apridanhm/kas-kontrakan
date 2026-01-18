<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\Expense;

class KasService
{
    public function totalIncome(): int
    {
        // pemasukan dari pembayaran yang SUDAH LUNAS
        return (int) \App\Models\Payment::where('status', 'paid')
        ->whereHas('category', function ($q) {
            $q->where('is_cash_based', true);
        })
        ->sum('amount');
    }

    public function totalExpense(): int
    {
        // pengeluaran kas
        return (int) Expense::sum('amount');
    }

    public function balance(): int
    {
        return $this->totalIncome() - $this->totalExpense();
    }
}
