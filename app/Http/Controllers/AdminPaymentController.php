<?php

namespace App\Http\Controllers;

use App\Models\Payment;

class AdminPaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['user', 'category'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.payments.index', compact('payments'));
    }

    public function approve(Payment $payment)
    {
        $payment->update([
            'status'  => 'paid',
            'paid_at'=> now(),
        ]);
    
        return back()->with('success', 'Pembayaran berhasil di-approve');
    }
    

    public function reject(Payment $payment)
    {
        $payment->delete();

        return back()->with('success', 'Pembayaran ditolak');
    }
}
