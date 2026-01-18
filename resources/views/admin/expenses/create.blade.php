@extends('layouts.app')

@section('content')

<div style="max-width:600px;background:#ffffff;padding:24px;border-radius:8px">

    <h1 style="font-size:20px;font-weight:bold;margin-bottom:16px">
        Tambah Pengeluaran
    </h1>

    <form method="POST"
          action="{{ route('admin.expenses.store') }}"
          enctype="multipart/form-data">

        @csrf

        <div style="margin-bottom:12px">
            <label>Judul</label><br>
            <input type="text"
                   name="title"
                   required
                   style="width:100%;padding:8px;border:1px solid #ccc">
        </div>

        <div style="margin-bottom:12px">
            <label>Nominal</label><br>
            <input type="number"
                   name="amount"
                   required
                   style="width:100%;padding:8px;border:1px solid #ccc">
        </div>

        <div style="margin-bottom:12px">
            <label>Foto Nota</label><br>
            <input type="file" name="proof">
        </div>

        {{-- TOMBOL SIMPAN (PASTI TERLIHAT) --}}
        <div style="margin-top:20px">
            <button type="submit"
                style="
                    background:#16a34a;
                    color:white;
                    padding:12px 20px;
                    border:none;
                    border-radius:6px;
                    font-weight:bold;
                    cursor:pointer;
                ">
                SIMPAN
            </button>
        </div>

    </form>

</div>

@endsection
