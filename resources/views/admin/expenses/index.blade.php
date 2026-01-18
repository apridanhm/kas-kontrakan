@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Pengeluaran Kas</h1>

<a href="{{ route('admin.expenses.create') }}"
   class="bg-blue-600 text-white px-3 py-2 rounded">
   + Tambah Pengeluaran
</a>

@if(session('success'))
    <div class="bg-green-100 p-3 mt-4">{{ session('success') }}</div>
@endif

<table class="w-full border mt-4">
    <thead>
        <tr>
            <th>Judul</th>
            <th>Nominal</th>
            <th>Nota</th>
            <th>Admin</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @forelse($expenses as $e)
        <tr class="border-t">
            <td>{{ $e->title }}</td>
            <td>Rp {{ number_format($e->amount) }}</td>
            <td>
                @if($e->proof)
                    <a href="{{ asset('storage/'.$e->proof) }}" target="_blank">
                        Lihat
                    </a>
                @else
                    -
                @endif
            </td>
            <td>{{ $e->user->name }}</td>
            <td>{{ $e->created_at->format('d M Y') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center p-4 text-gray-500">
                Belum ada pengeluaran
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
