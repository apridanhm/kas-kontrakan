<?php

namespace App\Http\Controllers;

use App\Models\PaymentInstallment;
use Illuminate\Http\Request;

class AdminPaymentController extends Controller
{
    public function index()
    {
        $installments = PaymentInstallment::with('payment.user', 'payment.category')
            ->orderByDesc('paid_at')
            ->get();

        return view('admin.payments.index', compact('installments'));
    }

    public function approve(PaymentInstallment $installment)
    {
        $installment->update([
            'is_approved' => true,
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Pembayaran disetujui');
    }

    public function reject(PaymentInstallment $installment)
    {
        $installment->delete();

        return back()->with('success', 'Pembayaran ditolak');
    }
}
