<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id')->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'default_amount' => 'nullable|integer|min:0',
        ]);

        Category::create([
            'name'           => $request->name,
            'default_amount' => $request->default_amount,
            'is_active'      => true,
            'is_cash_based'  => $request->has('is_cash_based'),
        ]);

        return redirect()->route('categories.index');
    }
}
