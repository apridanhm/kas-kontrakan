@extends('layouts.app')

@section('content')
<h1 class="text-xl font-bold mb-6">Dashboard Admin</h1>

{{-- SUMMARY --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
    <x-stat-card title="Total Pemasukan" :value="'Rp '.number_format($income)" color="green" />
    <x-stat-card title="Total Pengeluaran" :value="'Rp '.number_format($expense)" color="red" />
    <x-stat-card title="Saldo Kas" :value="'Rp '.number_format($balance)" color="indigo" />
</div>

<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
    <x-stat-card title="Total Member" :value="$members" />
    <x-stat-card title="Kategori" :value="$categories" />
    <x-stat-card title="Tagihan" :value="$payments" />
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
    <x-stat-card title="Pemasukan" :value="'Rp '.number_format($income)" color="green" />
    <x-stat-card title="Pengeluaran" :value="'Rp '.number_format($expense)" color="red" />
</div>


{{-- QUICK ACTION --}}
<div class="bg-white rounded-xl shadow-sm p-5">
    <h2 class="font-semibold mb-4">Aksi Cepat</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
        <a href="{{ route('admin.users.index') }}" class="btn-admin">Approve User</a>
        <a href="{{ route('admin.payments.index') }}" class="btn-admin">Tagihan</a>
        <a href="{{ route('admin.installments.index') }}" class="btn-admin">Cicilan</a>
        <a href="{{ route('admin.non-cash.index') }}" class="btn-admin">Non-Kas</a>
        <a href="{{ route('categories.index') }}" class="btn-admin">Kategori</a>
        <a href="{{ route('admin.expenses.index') }}" class="btn-admin">Pengeluaran</a>
    </div>
</div>
@endsection
