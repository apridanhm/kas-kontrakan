@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Approval Pembayaran</h1>

@if(session('success'))
    <div class="bg-green-100 p-3 mb-4">{{ session('success') }}</div>
@endif

<table class="w-full border">
    <thead>
        <tr>
            <th>User</th>
            <th>Kategori</th>
            <th>Nominal</th>
            <th>Bukti</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($installments as $i)
        <tr class="border-t">
            <td>{{ $i->payment->user->name ?? '-' }}</td>
            <td>{{ $i->payment->category->name ?? '-' }}</td>
            <td>Rp {{ number_format($i->amount) }}</td>
            <td>
                <a href="{{ asset('storage/'.$i->proof) }}" target="_blank">
                    Lihat Bukti
                </a>
            </td>
            <td>
                {{ $i->is_approved ? 'Approved' : 'Pending' }}
            </td>
            <td>
                @if(!$i->is_approved)
                    <form method="POST"
                          action="{{ route('admin.payments.approve', $i) }}"
                          class="inline">
                        @csrf
                        <button class="bg-green-600 text-white px-2 py-1">
                            Approve
                        </button>
                    </form>

                    <form method="POST"
                          action="{{ route('admin.payments.reject', $i) }}"
                          class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-600 text-white px-2 py-1">
                            Reject
                        </button>
                    </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
