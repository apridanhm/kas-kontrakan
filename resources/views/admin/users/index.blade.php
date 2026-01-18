@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-6">

    <h1 class="text-xl font-bold mb-4">Approve User</h1>

    <table class="w-full border">
        <tr class="bg-gray-100">
            <th class="p-2">Nama</th>
            <th>Email</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        @foreach($users as $user)
        <tr class="border-t">
            <td class="p-2">{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @if($user->is_active)
                    <span class="text-green-600">Aktif</span>
                @else
                    <span class="text-red-600">Pending</span>
                @endif
            </td>
            <td>
                @if(!$user->is_active)
                    <form method="POST"
                          action="{{ route('admin.users.approve', $user) }}">
                        @csrf
                        @method('PATCH')
                        <button class="text-blue-600 hover:underline">
                            Approve
                        </button>
                    </form>
                @endif
            </td>
        </tr>
        @endforeach
    </table>

</div>
@endsection
