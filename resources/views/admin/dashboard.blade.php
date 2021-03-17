@extends('layouts.admin')

@section('title', "Dashboard")

@php
    use \Carbon\Carbon;
@endphp

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
        <a href="{{ route('admin.kendaraan') }}">
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
        <a href="{{ route('admin.layananUnggulan') }}">
            <div class="bg-putih rounded bayangan-5 smallPadding">
                <div class="wrap super">
                    <h2 class="teks-tebal">{{ $layanan->count() }}</h2>
                    <div class="teks-transparan">layanan unggulan</div>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="mt-2">
    <div class="bagi bagi-2">
        <div class="wrap">
            <div class="bg-putih rounded bayangan-5 smallPadding">
                <div class="wrap">
                    <h3>Pengajuan Layanan Pembayaran PKB Tahunan Terbaru</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Perusahaan</th>
                                <th>Tanggal Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pkb as $pkb)
                                <tr>
                                    <td>{{ $pkb->company->name }}</td>
                                    <td>{{ Carbon::parse($pkb->payment_date)->isoFormat('D MMMM Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('admin.pkb') }}">
                        <button class="mt-2 lebar-100 hijau">Lihat Selengkapnya</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="bagi bagi-2">
        <div class="wrap">
            <div class="bg-putih rounded bayangan-5 smallPadding">
                <div class="wrap">
                    <h3>Laporan Status Kendaraan Terbaru</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Perusahaan</th>
                                <th>Nomor Polisi</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($statusKendaraan as $status)
                                <tr>
                                    <td>{{ $status->company->name }}</td>
                                    <td>{{ $status->nopol }}</td>
                                    <td>{{ $status->status }} </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('admin.kendaraanStatus') }}">
                        <button class="lebar-100 mt-2 hijau">Selengkapnya</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection