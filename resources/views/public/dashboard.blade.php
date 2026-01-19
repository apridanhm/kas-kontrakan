@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">

    {{-- RINGKASAN --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded shadow">
            <div class="text-sm text-gray-500">Pemasukan</div>
            <div class="text-lg font-bold text-green-600">
                Rp {{ number_format($income) }}
            </div>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <div class="text-sm text-gray-500">Pengeluaran</div>
            <div class="text-lg font-bold text-red-600">
                Rp {{ number_format($expense) }}
            </div>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <div class="text-sm text-gray-500">Saldo</div>
            <div class="text-lg font-bold">
                Rp {{ number_format($balance) }}
            </div>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <div class="text-sm text-gray-500">Jumlah Member</div>
            <div class="text-lg font-bold">
                {{ $members }}
            </div>
        </div>
    </div>

    {{-- STATUS PEMBAYARAN KAS --}}
    <div class="bg-white rounded shadow mb-6 overflow-x-auto">
        <h2 class="font-bold p-4 border-b">Status Pembayaran Kas</h2>

        <table class="w-full min-w-[600px]">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Kategori</th>
                    <th class="p-3 text-center">Lunas</th>
                    <th class="p-3 text-center">Cicil</th>
                    <th class="p-3 text-center">Belum Bayar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cashStatus as $category => $row)
                <tr class="border-t align-top">
                    <td class="p-3 font-medium">
                        {{ $category }}
                    </td>

                    {{-- LUNAS --}}
                    <td class="p-3 text-center">
                        <div class="font-bold text-green-600">
                            {{ $row['paid']->count() }}
                        </div>
                        <ul class="text-xs text-gray-600 mt-1">
                            @foreach($row['paid'] as $p)
                                <li>- {{ $p->user->name }}</li>
                            @endforeach
                        </ul>
                    </td>

                    {{-- CICIL --}}
                    <td class="p-3 text-center">
                        <div class="font-bold text-yellow-600">
                            {{ $row['partial']->count() }}
                        </div>
                        <ul class="text-xs text-gray-600 mt-1">
                            @foreach($row['partial'] as $p)
                                <li>- {{ $p->user->name }}</li>
                            @endforeach
                        </ul>
                    </td>

                    {{-- BELUM --}}
                    <td class="p-3 text-center">
                        <div class="font-bold text-red-600">
                            {{ $row['unpaid']->count() }}
                        </div>
                        <ul class="text-xs text-gray-600 mt-1">
                            @foreach($row['unpaid'] as $p)
                                <li>- {{ $p->user->name }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-500">
                        Tidak ada data pembayaran kas
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- STATUS PEMBAYARAN NON-KAS --}}
    <div class="bg-white rounded shadow overflow-x-auto">
        <h2 class="font-bold p-4 border-b">Status Pembayaran Non-Kas</h2>

        <table class="w-full min-w-[400px]">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Kategori</th>
                    <th class="p-3 text-center">Approved</th>
                    <th class="p-3 text-center">Pending</th>
                </tr>
            </thead>
            <tbody>
                @forelse($nonCashStatus as $category => $row)
                <tr class="border-t">
                    <td class="p-3 font-medium">
                        {{ $category }}
                    </td>
                    <td class="p-3 text-center font-bold text-green-600">
                        {{ $row['approved']->count() }}
                    </td>
                    <td class="p-3 text-center font-bold text-yellow-600">
                        {{ $row['pending']->count() }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="p-4 text-center text-gray-500">
                        Tidak ada data non-kas
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <p class="text-xs text-gray-500 px-4 py-3">
            Pembayaran non-kas (WiFi / Listrik) tidak mempengaruhi saldo kas.
        </p>
    </div>

</div>
@endsection
