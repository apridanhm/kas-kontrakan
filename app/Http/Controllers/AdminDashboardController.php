<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Payment;
use App\Services\KasService;

class AdminDashboardController extends Controller
{
    public function index(KasService $kas)
    {
        return view('admin.dashboard', [
            'totalUsers'      => User::count(),
            'totalCategories' => Category::count(),
            'totalPayments'   => Payment::count(),

            'totalIncome'     => $kas->totalIncome(),
            'totalExpense'    => $kas->totalExpense(),
            'balance'         => $kas->balance(),
        ]);
    }
}
