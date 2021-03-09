@extends('layouts.app')

@section('title', $layanan->nama)

@section('head.dependencies')
<style>
    .container {
        left: 0px;right: 0px;
    }
    .overlay {
        background-color: #00000080;
        height: 100%;
    }
    .content {
        position: absolute;
        width: 100%;
        background-color: #fff;
        border-top-left-radius: 25px;
        border-top-right-radius: 25px;
        margin-top: -50px;
    }
</style>
@endsection

@section('header')
<header>
    <a href="{{ route('app.layananUnggulan') }}">
        <div class="ml-2 bagi lebar-30">
            <i class="fas fa-angle-left mr-1"></i> kembali
        </div>
    </a>
</header>
@endsection

@section('content')
    <div class="cover tinggi-300" bg-image="{{ asset('storage/foto_layanan_unggulan/'.$layanan->foto) }}">
        <div class="overlay"></div>
    </div>
    <div class="content">
        <div class="wrap pt-3">
            <h2>{{ $layanan->nama }}</h2>
            <div class="teks-transparan">{{ $layanan->alamat }}</div>
            <div class="schedule mt-3">
                @foreach (json_decode($layanan->jadwal) as $jadwal)
                    <div class="bagi bagi-2 mt-2">
                        {{ $jadwal[0] }}
                    </div>
                    <div class="bagi bagi-2 mt-2">
                        {{ $jadwal[1] }}
                    </div>
                @endforeach
            </div>
            <button class="lebar-100 biru mt-4 pl-4 pr-4 rata-kiri">
                <i class="fas fa-phone-alt mr-1"></i>
                Hubungi
            </button>
        </div>
        <div class="tinggi-100"></div>
    </div>
@endsection
