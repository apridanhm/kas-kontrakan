<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Carbon\Carbon;

class MemberDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $now  = Carbon::now();

        $payments = Payment::with('installments', 'category')
            ->where('user_id', $user->id)
            ->where('month', $now->month)
            ->where('year', $now->year)
            ->orderBy('category_id')
            ->get();

        return view('member.dashboard', compact('payments'));
    }
}
