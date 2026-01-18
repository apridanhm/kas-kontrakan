<?php

namespace App\Services;

use App\Models\User;
use App\Models\Category;
use App\Models\Payment;
use Carbon\Carbon;

class BillingService
{
    public function generate(Carbon $date)
    {
        $month = $date->month;
        $year  = $date->year;

        $members = User::where('role', 'member')->get();
        $categories = Category::where('is_cash_based', 1)
            ->where('is_active', 1)
            ->get();

        foreach ($members as $user) {
            foreach ($categories as $cat) {

                // 🔒 Anti duplikat
                $exists = Payment::where([
                    'user_id'     => $user->id,
                    'category_id' => $cat->id,
                    'month'       => $month,
                    'year'        => $year,
                ])->exists();

                if ($exists) continue;

                // 🔁 Ambil sisa bulan lalu
                $last = Payment::where('user_id', $user->id)
                    ->where('category_id', $cat->id)
                    ->orderByDesc('year')
                    ->orderByDesc('month')
                    ->first();

                $carry = $last ? max(0, $last->amount - $last->paidTotal()) : 0;

                Payment::create([
                    'user_id'     => $user->id,
                    'category_id' => $cat->id,
                    'month'       => $month,
                    'year'        => $year,
                    'amount'      => ($cat->default_amount ?? 0) + $carry,
                    'status'      => 'unpaid',
                ]);
            }
        }
    }
}
