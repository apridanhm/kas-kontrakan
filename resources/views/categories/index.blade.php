@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-6">

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">Kategori Iuran</h1>

        <a href="{{ route('categories.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Tambah Kategori
        </a>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <table class="w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 text-left">Nama</th>
                    <th class="p-2 text-center">Default</th>
                    <th class="p-2 text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $cat)
                    <tr class="border-t">
                        <td class="p-2">{{ $cat->name }}</td>
                        <td class="p-2 text-center">
                            Rp {{ number_format($cat->default_amount ?? 0) }}
                        </td>
                        <td class="p-2 text-center">
                            <span class="{{ $cat->is_active ? 'text-green-600' : 'text-red-600' }}">
                                {{ $cat->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-4 text-center text-gray-500">
                            Belum ada kategori
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
