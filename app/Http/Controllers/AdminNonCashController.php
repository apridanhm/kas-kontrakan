<?php

namespace App\Http\Controllers;

use App\Models\NonCashPayment;

class AdminNonCashController extends Controller
{
    public function index()
    {
        $items = NonCashPayment::with('user','category')->latest()->get();
        return view('admin.non-cash.index', compact('items'));
    }

    public function approve(NonCashPayment $item)
    {
        $item->update([
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        return back()->with('success','Disetujui');
    }
}
