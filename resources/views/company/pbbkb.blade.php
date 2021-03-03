@extends('layouts.app')

@section('title', "Form Permohonan Menjadi Wajib Pajak Bahan Bakar Kendaraan Bermotor")

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
    @if ($datas->count() == 0)
        <h2>Form Permohonan Menjadi Wajib Pajak Bahan Bakar Kendaraan Bermotor</h2>
        <form action="{{ route('app.pbbkb.store') }}" method="POST">
            {{ csrf_field() }}
            <p>Dengan ini, saya menyatakan bahwa perusahaan di bawah ini :</p>
            <div class="mt-2">Nama Perusahaan :</div>
            <input type="text" class="box" name="name" readonly value="{{ $myData->name }}">
            <div class="mt-2">NPWP Perusahaan :</div>
            <input type="text" class="box" name="npwp" readonly value="{{ $myData->npwp }}">
            <div class="mt-2">Alamat :</div>
            <textarea name="address" readonly class="box">{{ $myData->address }}</textarea>
            <p>adalah benar dan ingin mengirimkan permohonan untuk menjadi Wajib Pajak Bahan Bakar Kendaraan Bermotor</p>

            <button class="mt-3 biru lebar-100">Submit</button>
        </form>
    @else
        <h3>
        Maaf, Anda tidak bisa mengirim permohonan menjadi Wajib Pajak Bahan Bakar Kendaraan Bermotor karena
        @if ($datas[0]->status == 1)
            perusahaan Anda telah diterima sebagai Wajib Pajak
        @elseif($datas[0]->status == 2)
            perusahaan Anda masih memiliki permohonan yang sedang kami tinjau
        @endif
        </h3>
    @endif
@endsection
