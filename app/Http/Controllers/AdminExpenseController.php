<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class AdminExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::with('user')
            ->latest()
            ->get();

        return view('admin.expenses.index', compact('expenses'));
    }

    public function create()
    {
        return view('admin.expenses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'  => 'required|string|max:255',
            'amount' => 'required|integer|min:1000',
            'proof'  => 'nullable|image|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('proof')) {
            $path = $request->file('proof')->store('expenses', 'public');
        }

        Expense::create([
            'title'   => $request->title,
            'amount'  => $request->amount,
            'proof'   => $path,
            'user_id' => auth()->id(),
        ]);

        return redirect()
            ->route('admin.expenses.index')
            ->with('success', 'Pengeluaran berhasil ditambahkan');
    }
}
