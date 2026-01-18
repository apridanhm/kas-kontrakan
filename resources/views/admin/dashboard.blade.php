@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Dashboard Admin</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">

    <div class="bg-white p-4 rounded shadow">
        <p class="text-gray-500">Total Pemasukan</p>
        <p class="text-xl font-bold text-green-600">
            Rp {{ number_format($totalIncome) }}
        </p>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <p class="text-gray-500">Total Pengeluaran</p>
        <p class="text-xl font-bold text-red-600">
            Rp {{ number_format($totalExpense) }}
        </p>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <p class="text-gray-500">Saldo Kas</p>
        <p class="text-xl font-bold {{ $balance >= 0 ? 'text-blue-600' : 'text-red-600' }}">
            Rp {{ number_format($balance) }}
        </p>
    </div>

</div>

<hr class="my-6">

<div class="grid grid-cols-3 gap-4">
    <div class="bg-white p-4 rounded shadow">
        <p>Total Member</p>
        <p class="text-lg font-bold">{{ $totalUsers }}</p>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <p>Total Kategori</p>
        <p class="text-lg font-bold">{{ $totalCategories }}</p>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <p>Total Tagihan</p>
        <p class="text-lg font-bold">{{ $totalPayments }}</p>
    </div>
</div>
@endsection
