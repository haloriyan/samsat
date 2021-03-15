@extends('layouts.app')

@section('head.dependencies')
<style>
    .greetings p {
        font-size: 15px;
        margin-top: 0px;
    }
    .greetings h3 {
        font-family: RobotoBold;
        font-size: 22px;
        margin-top: -10px;
    }
    .profile {
        background-color: #ecf0f1;
        border-radius: 900px;
        width: 100%;
        line-height: 60px;
    }
    .profile div {
        display: inline-block;
        margin: -2px;
    }
    .profile .bell {
        width: 60px;
        text-align: center;
        border-radius: 900px;
    }
    .profile .count {
        margin-right: 10px;
        font-size: 18px;
    }
    .item .cover {
        height: 150px;
        border-top-left-radius: 6px;
        border-top-right-radius: 6px;
    }
</style>
@endsection

@php
    $categories = ["Corner","Samling","Payment Point","Lainnya"]
@endphp

@section('content')
<div class="bagi bagi-1">
    <div class="greetings">
        <p class="teks-transparan">Info</p>
        <h3>Layanan Unggulan</h3>
    </div>
</div>

<br />

<select onchange="filter(this.value)" class="box mb-3">
    <option value="">Semua Layanan</option>
    @foreach ($categories as $category)
        @php
            $isSelected = $category == $req->category ? "selected='selected'" : "";
        @endphp
        <option {{ $isSelected }}>{{ $category }}</option>
    @endforeach
</select>

@foreach ($datas as $data)
<div class="bagi bagi-2">
    <div class="wrap">
        <a href="{{ route('app.layananUnggulan.detail', $data->id) }}">
            <div class="bg-putih rounded bayangan-5 item">
                <div class="cover" bg-image="{{ asset('storage/foto_layanan_unggulan/'.$data->foto) }}"></div>
                <div class="smallPadding">
                    <div class="wrap super">
                        <div class="teks-tebal mb-1">{{ $data->nama }}</div>
                        <div class="teks-kecil teks-transparan">{{ $data->alamat }}</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
@endforeach

@endsection

@section('javascript')
<script>
    let url = new URL(document.URL);
    const filter = value => {
        url.searchParams.set('category', value);
        window.location = url.toString();
    }
</script>
@endsection