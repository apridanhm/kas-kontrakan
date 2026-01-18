@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6">

    {{-- Ringkasan --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 shadow rounded">
            <div class="text-sm text-gray-500">Pemasukan</div>
            <div class="text-xl font-bold text-green-600">
                Rp {{ number_format($income) }}
            </div>
        </div>

        <div class="bg-white p-4 shadow rounded">
            <div class="text-sm text-gray-500">Pengeluaran</div>
            <div class="text-xl font-bold text-red-600">
                Rp {{ number_format($expense) }}
            </div>
        </div>

        <div class="bg-white p-4 shadow rounded">
            <div class="text-sm text-gray-500">Saldo</div>
            <div class="text-xl font-bold">
                Rp {{ number_format($balance) }}
            </div>
        </div>

        <div class="bg-white p-4 shadow rounded">
            <div class="text-sm text-gray-500">Jumlah Member</div>
            <div class="text-xl font-bold">
                {{ $members }}
            </div>
        </div>
    </div>

    {{-- ===================== --}}
    {{-- KAS --}}
    {{-- ===================== --}}
    <div class="bg-white shadow rounded p-4 mb-6">
        <h2 class="font-semibold mb-3">Status Pembayaran Kas</h2>

        <table class="w-full border">
            <tr class="bg-gray-100">
                <th class="p-2 text-left">Kategori</th>
                <th>Lunas</th>
                <th>Cicil</th>
                <th>Belum Bayar</th>
            </tr>

            @foreach($cashStatus as $category => $c)
            <tr class="border-t align-top">
                <td class="p-2 font-medium">{{ $category }}</td>

                {{-- LUNAS --}}
                <td class="text-green-600 p-2">
                    {{ $c['paid']->count() }}
                    @if($c['paid']->count())
                        <ul class="text-xs text-gray-600 mt-1">
                            @foreach($c['paid'] as $p)
                                <li>- {{ $p->user->name }}</li>
                            @endforeach
                        </ul>
                    @endif
                </td>

                {{-- CICIL --}}
                <td class="text-yellow-600 p-2">
                    {{ $c['partial']->count() }}
                    @if($c['partial']->count())
                        <ul class="text-xs text-gray-600 mt-1">
                            @foreach($c['partial'] as $p)
                                <li>- {{ $p->user->name }}</li>
                            @endforeach
                        </ul>
                    @endif
                </td>

                {{-- BELUM BAYAR --}}
                <td class="text-red-600 p-2">
                    {{ $c['unpaid']->count() }}
                    @if($c['unpaid']->count())
                        <ul class="text-xs text-gray-600 mt-1">
                            @foreach($c['unpaid'] as $p)
                                <li>- {{ $p->user->name }}</li>
                            @endforeach
                        </ul>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
    </div>

    {{-- ===================== --}}
    {{-- NON-KAS --}}
    {{-- ===================== --}}
    <div class="bg-white shadow rounded p-4">
        <h2 class="font-semibold mb-3">Status Pembayaran Non-Kas</h2>

        <table class="w-full border">
            <tr class="bg-gray-100">
                <th class="p-2 text-left">Kategori</th>
                <th>Approved</th>
                <th>Pending</th>
            </tr>

            @foreach($nonCashStatus as $category => $c)
            <tr class="border-t align-top">
                <td class="p-2 font-medium">{{ $category }}</td>

                {{-- APPROVED --}}
                <td class="text-green-600 p-2">
                    {{ $c['approved']->count() }}
                    @if($c['approved']->count())
                        <ul class="text-xs text-gray-600 mt-1">
                            @foreach($c['approved'] as $p)
                                <li>- {{ $p->user->name }}</li>
                            @endforeach
                        </ul>
                    @endif
                </td>

                {{-- PENDING --}}
                <td class="text-yellow-600 p-2">
                    {{ $c['pending']->count() }}
                    @if($c['pending']->count())
                        <ul class="text-xs text-gray-600 mt-1">
                            @foreach($c['pending'] as $p)
                                <li>- {{ $p->user->name }}</li>
                            @endforeach
                        </ul>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>

        <p class="text-xs text-gray-500 mt-2">
            Pembayaran non-kas (WiFi / Listrik) tidak mempengaruhi saldo kas.
        </p>
    </div>

</div>
@endsection
