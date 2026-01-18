<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PaymentInstallment;
use Illuminate\Http\Request;

class MemberPaymentController extends Controller
{
    // simpan cicilan + bukti
    public function storeInstallment(Request $request, $paymentId)
    {
        $request->validate([
            'amount' => 'required|integer|min:1',
            'proof'  => 'required|image|max:2048',
        ]);

        $payment = Payment::findOrFail($paymentId);

        // 🧱 STEP 3 — ANTI OVERPAY
        if ($request->amount > $payment->remaining()) {
            return back()->withErrors([
                'amount' => 'Nominal melebihi sisa tagihan'
            ]);
        }

        // simpan foto bukti
        $path = $request->file('proof')->store('payments', 'public');

        // simpan cicilan
        PaymentInstallment::create([
            'payment_id' => $payment->id,
            'amount'     => $request->amount,
            'proof'      => $path,
            'paid_at'    => now(),
        ]);

        // 🧱 STEP 4 — UPDATE STATUS OTOMATIS
        $total = $payment->paidTotal();

        if ($total == 0) {
            $payment->status = 'unpaid';
        } elseif ($total < $payment->amount) {
            $payment->status = 'partial';
        } else {
            $payment->status  = 'paid';
            $payment->paid_at = now();
        }

        $payment->save();

        return back()->with('success', 'Pembayaran berhasil disimpan');
    }
}
