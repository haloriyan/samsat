@extends('layouts.admin')

@section('title', "Dashboard")

@section('content')
<div class="bagi bagi-3">
    <div class="wrap">
        <a href="{{ route('admin.companies') }}">
            <div class="bg-putih rounded bayangan-5 smallPadding">
                <div class="wrap super">
                    <h2 class="teks-tebal">{{ $companies->count() }}</h2>
                    <div class="teks-transparan">perusahaan terdaftar</div>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="bagi bagi-3">
    <div class="wrap">
        <a href="{{ route('app.kendaraan') }}">
            <div class="bg-putih rounded bayangan-5 smallPadding">
                <div class="wrap super">
                    <h2 class="teks-tebal">{{ $kendaraan->count() }}</h2>
                    <div class="teks-transparan">kendaraan terdaftar</div>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="bagi bagi-3">
    <div class="wrap">
        <div class="bg-putih rounded bayangan-5 smallPadding">
            <div class="wrap super">
                <h2 class="teks-tebal">0</h2>
                <div class="teks-transparan">perusahaan terdaftar</div>
            </div>
        </div>
    </div>
</div>
@endsection