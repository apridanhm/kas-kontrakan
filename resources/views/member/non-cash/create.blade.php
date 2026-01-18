@extends('layouts.app')

@section('content')
<h1 class="text-xl font-bold mb-4">Upload Bukti Non-Kas</h1>

@if(session('success'))
<div class="bg-green-100 p-3 mb-4">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('member.non-cash.store') }}" enctype="multipart/form-data">
@csrf

<label>Kategori</label>
<select name="category_id" class="border p-2 w-full mb-3">
@foreach($categories as $c)
<option value="{{ $c->id }}">{{ $c->name }}</option>
@endforeach
</select>

<label>Nominal</label>
<input type="number" name="amount" class="border p-2 w-full mb-3">

<label>Foto Bukti</label>
<input type="file" name="proof" class="mb-3">

<button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
Kirim Bukti
</button>
</form>
@endsection
