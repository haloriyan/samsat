@extends('layouts.app')

@section('title', "Pengajuan Layanan Pembayaran Kendaran Bermotor Tahunan")

@section('head.dependencies')
    <link rel="stylesheet" href="{{ asset('js/flatpickr/dist/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/flatpickr/dist/themes/material_blue.css') }}">
@endsection

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
    <h2>Pengajuan Layanan Pembayaran Pajak Kendaran Bermotor Tahunan</h2>
    <form action="{{ route('app.pkbTahunan.store') }}" method="POST">
        {{ csrf_field() }}
        <div class="mt-2">Nomor Polisi :</div>
        <div id="nopolArea">
            <input type="text" class="box" name="nopol[]" placeholder="contoh : L 3156 JV" required>
        </div>
        <button type="button" class="mt-2" onclick="addNopol()"><i class="fas fa-plus mr-1"></i> Nomor Lainnya</button>
        <div class="mt-2">Tanggal Pembayaran :</div>
        <input type="text" class="box" name="payment_date" id="paymentDate" required>

        <button class="mt-3 biru lebar-100">Submit</button>
    </form>
@endsection

@section('javascript')
<script src="{{ asset('js/flatpickr/dist/flatpickr.min.js') }}"></script>
<script>
    const addNopol = () => {
        createElement({
            el: 'input',
            attributes: [
                ['type', 'text'],
                ['name', 'nopol[]'],
                ['class', 'box']
            ],
            createTo: '#nopolArea'
        });
    }

    flatpickr("#paymentDate", {
        dateFormat: 'Y-m-d'
    })
</script>
@endsection
