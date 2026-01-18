@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-6">
<h1 class="text-xl font-bold mb-4">Approval Cicilan</h1>

@if(session('success'))
<div class="bg-green-100 p-3 mb-3">{{ session('success') }}</div>
@endif

<table class="w-full border">
<tr class="bg-gray-100">
    <th>User</th>
    <th>Kategori</th>
    <th>Nominal</th>
    <th>Bukti</th>
    <th>Aksi</th>
</tr>

@forelse($items as $i)
<tr class="border-t">
    <td>{{ $i->payment->user->name }}</td>
    <td>{{ $i->payment->category->name }}</td>
    <td>Rp {{ number_format($i->amount) }}</td>
    <td>
        <a href="{{ asset('storage/'.$i->proof) }}" target="_blank">Lihat</a>
    </td>
    <td class="flex gap-2">
        <form method="POST" action="{{ route('admin.installments.approve',$i) }}">
            @csrf
            <button class="bg-green-600 text-white px-2 py-1">Approve</button>
        </form>

        <form method="POST" action="{{ route('admin.installments.reject',$i) }}">
            @csrf @method('DELETE')
            <button class="bg-red-600 text-white px-2 py-1">Reject</button>
        </form>
    </td>
</tr>
@empty
<tr>
    <td colspan="5" class="text-center p-4 text-gray-500">
        Tidak ada cicilan pending
    </td>
</tr>
@endforelse
</table>
</div>
@endsection
