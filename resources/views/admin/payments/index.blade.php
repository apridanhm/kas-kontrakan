@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-6">

    <h1 class="text-xl font-bold mb-4">Approval Pembayaran Kas</h1>

    <div class="bg-white p-4 rounded shadow overflow-x-auto">
        <table class="w-full border text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 text-left">User</th>
                    <th class="p-2 text-left">Kategori</th>
                    <th class="p-2 text-center">Nominal</th>
                    <th class="p-2 text-center">Bukti</th>
                    <th class="p-2 text-center">Status</th>
                    <th class="p-2 text-center w-40">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-2">{{ $payment->user->name ?? '-' }}</td>
                        <td class="p-2">{{ $payment->category->name }}</td>
                        <td class="p-2 text-center">
                            Rp {{ number_format($payment->amount) }}
                        </td>
                        <td class="p-2 text-center">
                            <a href="{{ asset('storage/'.$payment->proof) }}"
                               target="_blank"
                               class="text-blue-600 hover:underline">
                                Lihat Bukti
                            </a>
                        </td>
                        <td class="p-2 text-center">
                            <span class="px-2 py-1 rounded text-xs
                                {{ $payment->status === 'approved'
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-yellow-100 text-yellow-700' }}">
                                {{ ucfirst($payment->status) }}
                            </span>
                        </td>
                        <td class="p-2 text-center">
                            @if($payment->status !== 'approved')
                                <form method="POST"
                                      action="{{ route('admin.payments.approve', $payment) }}">
                                    @csrf
                                    <button class="text-blue-600 hover:underline">
                                        Approve
                                    </button>
                                </form>
                            @else
                                —
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6"
                            class="p-4 text-center text-gray-500">
                            Tidak ada pembayaran
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
