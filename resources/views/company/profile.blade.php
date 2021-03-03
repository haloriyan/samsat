@extends('layouts.app')

@section('title', "Profile")

@section('head.dependencies')
<style>
    .initialIcon {
        width: 100px;
        line-height: 100px;
        display: inline-block;
        border-radius: 250px;
        font-size: 22px;
        font-family: RobotoBold;
        letter-spacing: 2px;
    }
</style>
@endsection

@section('content')
    <div class="rata-tengah mb-4">
        <div class="initialIcon bg-biru">
            {{ $myData->initial }}
        </div>
    </div>
    @if ($message != "")
        <div class="bg-hijau-transparan p-2 rounded">
            {{ $message }}
        </div>
    @endif
    <form action="{{ route('app.updateProfile') }}" method="POST">
        {{ csrf_field() }}
        <div class="mt-2">Nama Perusahaan :</div>
        <input type="text" class="box" name="name" required value="{{ $myData->name }}">
        <div class="mt-2">Email :</div>
        <input type="email" class="box" name="email" required value="{{ $myData->email }}">
        <div class="mt-2">No. WhatsApp :</div>
        <input type="text" class="box" name="phone" required value="{{ $myData->phone }}">
        <div class="mt-2">NPWP Perusahaan :</div>
        <input type="text" class="box" name="npwp" required value="{{ $myData->npwp }}">
        <div class="mt-2">Alamat :</div>
        <textarea name="address" class="box">{{ $myData->address }}</textarea>

        <button class="lebar-100 biru mt-3">Ubah Profil</button>
        <a href="{{ route('app.index') }}">
            <button type="button" class="lebar-100 mt-2">kembali ke Halaman Utama</button>
        </a>
    </form>
@endsection