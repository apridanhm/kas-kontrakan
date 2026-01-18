@extends('layouts.app')

@section('content')

<h1 class="text-xl font-bold mb-4">Dashboard Member</h1>

@if ($payments->isEmpty())
    <p>Belum ada tagihan.</p>
@else
    @foreach ($payments as $payment)
        <div class="border p-3 mb-3">
            <p>Kategori: {{ $payment->category_id }}</p>
            <p>Nominal: Rp {{ number_format($payment->amount) }}</p>
            <p>Status: {{ $payment->status }}</p>
        </div>
    @endforeach
@endif

@endsection
