<?php

namespace App\Http\Controllers;

use App\Models\PaymentInstallment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminInstallmentController extends Controller
{
    public function index()
    {
        $items = PaymentInstallment::with([
                'payment.user',
                'payment.category'
            ])
            ->where('is_approved', 0)
            ->latest()
            ->get();

        return view('admin.installments.index', compact('items'));
    }

    public function approve(PaymentInstallment $installment)
    {
        DB::transaction(function () use ($installment) {

            $installment->update([
                'is_approved' => 1,
                'approved_at' => now(),
                'paid_at'     => now(),
            ]);

            $payment = $installment->payment;

            $totalPaid = $payment->installments()
                ->where('is_approved', 1)
                ->sum('amount');

            if ($totalPaid >= $payment->amount) {
                $payment->update([
                    'status'  => 'paid',
                    'paid_at' => now(),
                ]);
            } elseif ($totalPaid > 0) {
                $payment->update(['status' => 'partial']);
            }
        });

        return back()->with('success', 'Cicilan disetujui');
    }

    public function reject(PaymentInstallment $installment)
    {
        $installment->delete();

        return back()->with('success', 'Cicilan ditolak');
    }
}
