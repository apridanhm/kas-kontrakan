<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\NonCashPayment;
use Illuminate\Http\Request;

class MemberNonCashController extends Controller
{
    public function create()
    {
        $categories = Category::where('is_cash_based', false)->where('is_active', true)->get();
        return view('member.non-cash.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount'      => 'required|integer|min:1000',
            'proof'       => 'required|image|max:2048',
        ]);

        $path = $request->file('proof')->store('non-cash', 'public');

        NonCashPayment::create([
            'user_id'     => auth()->id(),
            'category_id' => $request->category_id,
            'amount'      => $request->amount,
            'proof'       => $path,
            'status'      => 'pending',
        ]);

        return redirect()->back()->with('success', 'Bukti dikirim, menunggu approval admin.');
    }
}
