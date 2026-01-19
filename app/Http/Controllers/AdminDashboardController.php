<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Payment;
use App\Models\Expense;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // === SUMMARY KEUANGAN ===
        $income = Payment::where('status', 'paid')
            ->whereHas('category', fn ($q) => $q->where('is_cash_based', 1))
            ->sum('amount');

        $expense = Expense::sum('amount');
        $balance = $income - $expense;

        // === STATISTIK ===
        $members    = User::where('role', 'member')->count();
        $categories = Category::count();
        $payments   = Payment::count();

        return view('admin.dashboard', compact(
            'income',
            'expense',
            'balance',
            'members',
            'categories',
            'payments'
        ));
    }
}
