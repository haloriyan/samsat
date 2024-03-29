@extends('layouts.app')

@section('title', "Home")

@section('head.dependencies')
<style>
    .greetings p {
        font-size: 14px;
        margin-top: 0px;
    }
    .greetings h3 {
        font-family: RobotoBold;
        font-size: 22px;
        margin-top: 0px;
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

    .slider {
        overflow-x: scroll;
        overflow-y: hidden;
        white-space: nowrap;
        height: 180px;
    }
    .slider .item {
        width: 90%;
        margin-right: 2.5%;
        height: 180px;
        display: inline-block;
        vertical-align: top;
        border-radius: 6px;
    }


	.services .item { height: 165px; }
    .services.special .item {
        height: 90px;
        box-shadow: none;
        border: 1px solid #3498db;
        color: #3498db;
    }
    .services .icon { font-size: 40px; }
    .services h3 {
        color: #fff;
		font-size: 20px;
		font-family: RobotoBold;
		margin-bottom: 5px;
	}
	.services p {
		margin-top: 0px;
		font-size: 13px;
	}
    .services .item.info h3 { color: #444; }
    .services.special .item h3 { margin: 0px;color: #3498db; }
</style>
@endsection

@section('content')
<div class="bagi bagi-2">
    <div class="greetings">
        <p class="teks-transparan">Halo</p>
        <h3>{{ $myData->first_name }}</h3>
    </div>
</div>
<div class="bagi bagi-2 rata-kanan">
    <a href="{{ route('app.notification') }}">
        <div class="profile">
            <div class="count">{{ $notifications->count() }}</div>
            <div class="bell bg-biru">
                <i class="fas fa-bell"></i>
            </div>
        </div>
    </a>
</div>

<div class="slider mt-3">
    <a href="{{ route('app.pkbTahunan') }}">
        <div class="item" bg-image="{{ asset('images/slider.jpg') }}"></div>
	</a>
	<div class="item" bg-image="{{ asset('images/slider-2.jpg') }}"></div>
    <div class="item" bg-image="{{ asset('images/payment.jpg') }}"></div>
</div>

<div class="tiles mt-4">
    <div class="bagi bagi-2 services rata-tengah">
        <div class="wrap">
            <a href="{{ route('app.kendaraan') }}">
                <div class="bg-biru item rounded smallPadding">
                    <div class="wrap super">
                        <div class="icon"><i class="fas fa-car"></i></div>
                        <h3 class="">Tambah Data</h3>
                        <p>Kendaraan Bermotor Perusahaan</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="bagi bagi-2 services rata-tengah">
        <div class="wrap">
            <a href="{{ route('app.kendaraanStatus') }}">
                <div class="bg-biru item rounded smallPadding">
                    <div class="wrap super">
                        <div class="icon"><i class="fas fa-list"></i></div>
                        <h3 class="">Lapor Status</h3>
                        <p>Kendaraan Bermotor Perusahaan</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    {{-- <div class="bagi bagi-2 services rata-tengah">
        <div class="wrap">
            <a href="{{ route('app.pkbTahunan') }}">
                <div class="bg-biru item rounded smallPadding">
                    <div class="wrap super">
                        <div class="icon"><i class="fas fa-calendar"></i></div>
                        <h3 class="">Pembayaran PKB Tahunan</h3>
                    </div>
                </div>
            </a>
        </div>
    </div> --}}
    <div class="bagi bagi-2 services rata-tengah">
        <div class="wrap">
            <a href="{{ route('app.rju') }}">
                <div class="bg-biru item rounded smallPadding">
                    <div class="wrap super">
                        <div class="icon"><i class="fas fa-tags"></i></div>
                        <h3 class="">RJU</h3>
                        <p>Retribusi Jasa Usaha</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="bagi bagi-2 services rata-tengah">
        <div class="wrap">
            <a href="{{ route('app.pap') }}">
                <div class="bg-biru item rounded smallPadding">
                    <div class="wrap super">
                        <div class="icon"><i class="fas fa-water"></i></div>
                        <h3 class="">PAP</h3>
                        <p>Pajak Air Permukaan</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="bagi bagi-2 services rata-tengah">
        <div class="wrap">
            <a href="{{ route('app.pbbkb') }}">
                <div class="bg-biru item rounded smallPadding">
                    <div class="wrap super">
                        <div class="icon"><i class="fas fa-motorcycle"></i></div>
                        <h3 class="">PBBKB</h3>
                        <p>Pajak Bahan Bakar Kendaraan Bermotor</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    {{-- <div class="bagi bagi-2 services rata-tengah">
        <div class="wrap">
            <a href="{{ route('app.payment') }}">
                <div class="bg-biru item rounded smallPadding">
                    <div class="wrap super">
                        <div class="icon"><i class="fas fa-money-bill-alt"></i></div>
                        <h3 class="">Pembayaran</h3>
                        <p>Informasi Pembayaran</p>
                    </div>
                </div>
            </a>
        </div>
    </div> --}}
    <div class="bagi bagi-2 rata-tengah mt-2">
        <a href="{{ route('app.layananUnggulan') }}">
            <div class="bayangan-5 item rounded smallPadding info pt-3 pb-3">
                <div class="wrap super rata-tengah">
                    <i class="fas fa-info"></i>
                    <h3 class="teks-merah">Info Lainnya</h3>
                </div>
            </div>
        </a>
    </div>

    @if ($payments->count() != 0)
        <div class="tinggi-40"></div>
        <h3>Channel Pembayaran</h3>
        @foreach ($payments as $payment)
            <div class="bagi bagi-2">
                <div class="wrap">
                    <a href="{{ route('app.payment.detail', $payment->id) }}">
                        <div class="bg-putih rounded bayangan-5 smallPadding mb-3">
                            <div class="wrap">
                                <div class="tinggi-45 mb-3 rounded" bg-image="{{ asset('storage/payment_image/'.$payment->image) }}"></div>
                                <h4 class="m-0 mb-1 rata-tengah">{{ $payment->title }}</h4>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    @endif
</div>

<div class="bg"></div>
<div class="popupWrapper" id="notification">
    <div class="popup">
        <div class="wrap">
            <p id="message"></p>
            <button class="lebar-100 mt-2 hijau" onclick="hilangPopup('#notification')">tutup</button>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    @if ($message != "")
        <script>
            munculPopup("#notification");
            select("#notification p").innerText = "{{ $message }}";
        </script>
    @endif
@endsection
