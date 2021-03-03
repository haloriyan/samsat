@extends('layouts.app')

@section('title', "Form Permohonan Menjadi Wajib Retribusi Jasa Usaha")

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
    <div class="tinggi-40"></div>
    <h2>Form Permohonan Menjadi Wajib Retribusi Jasa Usaha</h2>
    <form action="{{ route('app.rju.store') }}" method="POST">
        {{ csrf_field() }}
        <div class="mt-2">Nama Penanggung Jawab :</div>
        <input type="text" class="box" name="name" required>
        <div class="mt-2">Alamat Penanggung Jawab :</div>
        <textarea name="address" class="box" required></textarea>
        <div class="mt-2">NPWP Penanggung Jawab :</div>
        <input type="text" class="box" name="npwp" required>
        <div class="mt-2">No. WhatsApp Penanggung Jawab :</div>
        <input type="text" class="box" name="phone" required>

        <button class="mt-3 biru lebar-100">Submit</button>
    </form>
@endsection
