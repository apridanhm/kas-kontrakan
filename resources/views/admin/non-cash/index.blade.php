@extends('layouts.app')

@section('content')
<h1 class="text-xl font-bold mb-4">Approval Non-Kas</h1>

@if(session('success'))
<div class="bg-green-100 p-3 mb-3">{{ session('success') }}</div>
@endif

<table class="w-full border">
<tr><th>User</th><th>Kategori</th><th>Nominal</th><th>Bukti</th><th>Status</th><th>Aksi</th></tr>
@foreach($items as $i)
<tr class="border-t">
<td>{{ $i->user->name }}</td>
<td>{{ $i->category->name }}</td>
<td>Rp {{ number_format($i->amount) }}</td>
<td><a href="{{ asset('storage/'.$i->proof) }}" target="_blank">Lihat</a></td>
<td>{{ $i->status }}</td>
<td>
@if($i->status === 'pending')
<form method="POST" action="{{ route('admin.non-cash.approve', $i->id) }}">
    @csrf
    @method('PATCH')

    <button
    type="submit"
    class="px-3 py-1 text-sm font-bold
           bg-red-600 text-white
           border border-red-800
           rounded shadow">
    APPROVE
</button>

</form>
@else
<span class="text-gray-500">—</span>
@endif
</td>

</tr>
@endforeach
</table>
@endsection
