@extends('layouts.app')

@section('title', "Home")

@section('head.dependencies')
<style>
    .greetings p {
        font-size: 15px;
        margin-top: 0px;
    }
    .greetings h3 {
        font-family: RobotoBold;
        font-size: 24px;
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
        height: 150px;
    }
    .slider .item {
        width: 90%;
        margin-right: 2.5%;
        height: 150px;
        display: inline-block;
        vertical-align: top;
        border-radius: 6px;
    }


	.services .item {
		height: 165px;
	}
    .services .icon {
        font-size: 40px;
    }
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
</style>
@endsection

@section('content')
<div class="bagi bagi-2">
    <div class="greetings">
        <p class="teks-transparan">SAMSAT</p>
        <h3>SUTRA GO</h3>
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
    <div class="item" bg-image="{{ asset('images/surabaya.jpg') }}"></div>
    <div class="item" bg-image="{{ asset('images/sutra-go.png') }}"></div>
    <div class="item" bg-image="{{ asset('images/water.jpg') }}"></div>
</div>

<div class="tiles mt-4">
    <div class="bagi bagi-2 services rata-tengah">
        <div class="wrap">
            <div class="bg-biru item rounded smallPadding">
                <div class="wrap super">
                    <div class="icon"><i class="fas fa-list"></i></div>
                    <h3 class="">Pelaporan Status</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="bagi bagi-2 services rata-tengah">
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
    </div>
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
    <div class="bagi bagi-2 services rata-tengah">
        <div class="wrap">
            <div class="bayangan-5 item rounded smallPadding info">
                <div class="wrap super">
                    <div class="icon"><i class="fas fa-info"></i></div>
                    <h3 class="teks-merah">Info Lainnya</h3>
                </div>
            </div>
        </div>
    </div>
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
