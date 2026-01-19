@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-6">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">Manajemen User</h1>
    </div>

    {{-- FLASH MESSAGE --}}
    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 bg-red-100 text-red-700 px-4 py-2 rounded">
            {{ session('error') }}
        </div>
    @endif

    {{-- TABLE CARD --}}
    <div class="bg-white p-4 rounded shadow overflow-x-auto">
        <table class="w-full border text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 text-left">Nama</th>
                    <th class="p-2 text-left">Email</th>
                    <th class="p-2 text-center">Status</th>
                    <th class="p-2 text-center w-56">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($users as $user)
                    <tr class="border-t hover:bg-gray-50">
                        {{-- NAMA --}}
                        <td class="p-2">
                            {{ $user->name }}
                        </td>

                        {{-- EMAIL --}}
                        <td class="p-2">
                            {{ $user->email }}
                        </td>

                        {{-- STATUS --}}
                        <td class="p-2 text-center">
                            @if($user->is_active)
                                <span class="px-2 py-1 rounded text-xs bg-green-100 text-green-700">
                                    Aktif
                                </span>
                            @else
                                <span class="px-2 py-1 rounded text-xs bg-gray-200 text-gray-700">
                                    Nonaktif
                                </span>
                            @endif
                        </td>

                        {{-- AKSI --}}
                        <td class="p-2 text-center">
                            <div class="flex justify-center gap-3">

                                {{-- APPROVE --}}
                                @if(!$user->is_active)
                                    <form method="POST"
                                          action="{{ route('admin.users.approve', $user) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button
                                            class="text-blue-600 hover:underline">
                                            Approve
                                        </button>
                                    </form>
                                @endif

                                {{-- NONAKTIFKAN --}}
                                @if($user->is_active && $user->role !== 'admin')
                                    <form method="POST"
                                          action="{{ route('admin.users.disable', $user) }}"
                                          onsubmit="return confirm('Nonaktifkan user ini?')">
                                        @csrf
                                        @method('PATCH')
                                        <button
                                            class="text-yellow-600 hover:underline">
                                            Nonaktifkan
                                        </button>
                                    </form>
                                @endif

                                {{-- HAPUS --}}
                                @if(!$user->is_active && $user->role !== 'admin')
                                    <form method="POST"
                                          action="{{ route('admin.users.destroy', $user) }}"
                                          onsubmit="return confirm('Yakin hapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="text-red-600 hover:underline">
                                            Hapus
                                        </button>
                                    </form>
                                @endif

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4"
                            class="p-4 text-center text-gray-500">
                            Belum ada user
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
