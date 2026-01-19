@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-6">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">Pengeluaran Kas</h1>

        <a href="{{ route('admin.expenses.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Tambah Pengeluaran
        </a>
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
                    <th class="p-2 text-left">Judul</th>
                    <th class="p-2 text-center">Nominal</th>
                    <th class="p-2 text-center">Nota</th>
                    <th class="p-2 text-left">Admin</th>
                    <th class="p-2 text-center">Tanggal</th>
                </tr>
            </thead>

            <tbody>
                @forelse($expenses as $e)
                    <tr class="border-t hover:bg-gray-50">

                        {{-- JUDUL --}}
                        <td class="p-2">
                            {{ $e->title }}
                        </td>

                        {{-- NOMINAL --}}
                        <td class="p-2 text-center">
                            Rp {{ number_format($e->amount) }}
                        </td>

                        {{-- NOTA --}}
                        <td class="p-2 text-center">
                            @if($e->proof)
                                <a href="{{ asset('storage/'.$e->proof) }}"
                                   target="_blank"
                                   class="text-blue-600 hover:underline">
                                    Lihat
                                </a>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </td>

                        {{-- ADMIN --}}
                        <td class="p-2">
                            {{ $e->user->name }}
                        </td>

                        {{-- TANGGAL --}}
                        <td class="p-2 text-center">
                            {{ $e->created_at->format('d M Y') }}
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5"
                            class="p-4 text-center text-gray-500">
                            Belum ada pengeluaran
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
