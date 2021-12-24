@extends('layouts.app')

@section('title', "Informasi Pembayaran")

@section('head.dependencies')
<style>
    .floatingButton {
        position: fixed;
        bottom: 80px;left: 5%;right: 5%;
        width: 90%;
    }
</style>
@endsection
    
@section('header')
<header>
    <a href="{{ route('app.index') }}">
        <div class="ml-2 bagi lebar-10">
            <i class="fas fa-angle-left mr-1"></i>
        </div>
    </a>
    Pembayaran melalui {{ $payment->title }}
</header>
@endsection

@section('content')
<div class="tinggi-50"></div>

<div class="tinggi-110 rounded mb-3" bg-image="{{ asset('storage/payment_image/'.$payment->image) }}"></div>

<pre>{{ $payment->instruction }}</pre>

<div class="tinggi-50"></div>

@if ($payment->link != "")
    <a href="{{ $payment->link }}" target="_blank">
        <button class="floatingButton bg-biru rounded-circle">Bayar</button>
    </a>
@endif

@endsection