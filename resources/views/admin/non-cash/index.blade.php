@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-6">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">Approval Pembayaran Non-Kas</h1>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- TABLE WRAPPER --}}
    <div class="bg-white p-4 rounded shadow">
        <table class="w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 text-left">Member</th>
                    <th class="p-2 text-left">Kategori</th>
                    <th class="p-2 text-center">Nominal</th>
                    <th class="p-2 text-center">Bukti</th>
                    <th class="p-2 text-center">Status</th>
                    <th class="p-2 text-center w-40">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($items as $i)
                    <tr class="border-t hover:bg-gray-50">

                        {{-- MEMBER --}}
                        <td class="p-2">
                            {{ $i->user->name }}
                        </td>

                        {{-- KATEGORI --}}
                        <td class="p-2">
                            {{ $i->category->name }}
                        </td>

                        {{-- NOMINAL --}}
                        <td class="p-2 text-center">
                            Rp {{ number_format($i->amount) }}
                        </td>

                        {{-- BUKTI --}}
                        <td class="p-2 text-center">
                            <a href="{{ asset('storage/'.$i->proof) }}"
                               target="_blank"
                               class="text-blue-600 hover:underline">
                                Lihat
                            </a>
                        </td>

                        {{-- STATUS --}}
                        <td class="p-2 text-center">
                            @if($i->status === 'approved')
                                <span class="text-green-600 font-semibold">
                                    Approved
                                </span>
                            @else
                                <span class="text-yellow-600 font-semibold">
                                    Pending
                                </span>
                            @endif
                        </td>

                        {{-- AKSI --}}
                        <td class="p-2 text-center">
                            @if($i->status === 'pending')
                                <form method="POST"
                                      action="{{ route('admin.non-cash.approve', $i->id) }}"
                                      class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button
                                        class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700">
                                        Approve
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6"
                            class="p-4 text-center text-gray-500">
                            Tidak ada pembayaran non-kas
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
