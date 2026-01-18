<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\NonCashPayment;
use App\Models\Category;
use App\Models\User;
use App\Models\Expense;
use Carbon\Carbon;

class PublicDashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        /**
         * =====================
         * RINGKASAN KAS
         * =====================
         */
        $income = Payment::where('status', 'paid')
            ->whereHas('category', function ($q) {
                $q->where('is_cash_based', 1);
            })
            ->whereHas('user', function ($q) {
                $q->where('role', 'member'); // ⬅️ admin TIDAK dihitung
            })
            ->sum('amount');

        $expense = Expense::sum('amount');
        $balance = $income - $expense;

        $members = User::where('role', 'member')->count();

        /**
         * =====================
         * STATUS PEMBAYARAN KAS
         * =====================
         */
        $cashCategories = Category::where('is_cash_based', 1)
            ->where('is_active', 1)
            ->get();

        $cashStatus = [];

        foreach ($cashCategories as $cat) {

            $payments = Payment::where('category_id', $cat->id)
                ->where('month', $now->month)
                ->where('year', $now->year)
                ->whereHas('user', function ($q) {
                    $q->where('role', 'member'); // ⬅️ FILTER MEMBER ONLY
                })
                ->with('user')
                ->get();

            $cashStatus[$cat->name] = [
                'paid'    => $payments->where('status', 'paid'),
                'partial' => $payments->where('status', 'partial'),
                'unpaid'  => $payments->where('status', 'unpaid'),
            ];
        }

        /**
         * =====================
         * STATUS PEMBAYARAN NON-KAS
         * =====================
         */
        $nonCashCategories = Category::where('is_cash_based', 0)
            ->where('is_active', 1)
            ->get();

        $nonCashStatus = [];

        foreach ($nonCashCategories as $cat) {

            $nonCashStatus[$cat->name] = [
                'approved' => NonCashPayment::where('category_id', $cat->id)
                    ->where('status', 'approved')
                    ->whereHas('user', function ($q) {
                        $q->where('role', 'member'); // ⬅️ admin TIDAK masuk
                    })
                    ->with('user')
                    ->get(),

                'pending' => NonCashPayment::where('category_id', $cat->id)
                    ->where('status', 'pending')
                    ->whereHas('user', function ($q) {
                        $q->where('role', 'member');
                    })
                    ->with('user')
                    ->get(),
            ];
        }

        return view('public.dashboard', compact(
            'income',
            'expense',
            'balance',
            'members',
            'cashStatus',
            'nonCashStatus'
        ));
    }
}
