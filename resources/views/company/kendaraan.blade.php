@extends('layouts.app')

@section('title', "Form Tambah Data Kendaraan")

@section('header')
<header>
    <a href="{{ route('app.index') }}">
        <div class="ml-2 bagi lebar-30">
            <i class="fas fa-angle-left mr-1"></i> kembali
        </div>
    </a>
</header>
@endsection

@section('content')
    <div class="tinggi-50"></div>
    <h2>Form Tambah Data Kendaraan</h2>
    <form action="{{ route('app.kendaraan.store') }}" method="POST" class="mt-4">
        {{ csrf_field() }}
        <div class="mt-2">Nomor Polisi :</div>
        <input type="text" class="box" name="nopol" required>
        <div class="mt-2">Nomor Rangka :</div>
        <input type="text" class="box" name="nomor_rangka" required>
        <button class="mt-3 biru lebar-100">Submit</button>
    </form>
@endsection