@extends('layouts.app')

@section('title', "Pelaporan Status Kendaraan Bermotor Perusahaan")

@section('head.dependencies')
<style>
    video#camera,canvas#cameraResult {
        width: 100%;
    }
</style>
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
    <div class="tinggi-50"></div>
    <h2>Pelaporan Status Kendaraan Bermotor Perusahaan</h2>
    <form action="{{ route('app.kendaraanStatus.store') }}" method="POST" class="mt-4">
        {{ csrf_field() }}
        <div class="mt-2">Nomor Polisi :</div>
        <input type="text" class="box" name="nopol" required>
        <div class="mt-2">Status :</div>
        <select name="status" class="box" onchange="changeStatus(this.value)" required>
            <option value="">-- PILIH STATUS --</option>
            <option>Jual</option>
            <option>Rusak</option>
            <option>Hilang</option>
        </select>

        <div id="keteranganArea">
            {{--  --}}
        </div>

        <button class="mt-3 biru lebar-100">Submit</button>
    </form>
@endsection

@section('javascript')
<script>
    let video = canvas = ctx = null;
    
    const startCamera = () => {
        video  = select("#camera");
        canvas = select("#cameraResult");
        ctx    = canvas.getContext('2d');
        select("#keterangan").value = "";
        
        video.classList.remove('d-none');
        canvas.classList.add('d-none');
        select("#captureButton").classList.remove('d-none');
        
        navigator.mediaDevices.getUserMedia({
            video: true,
        })
        .then(cam => {
            video.srcObject = cam;
            video.play();
        });
    }

    const capture = () => {
        canvas.width = video.clientWidth;
        canvas.height = video.clientHeight;

        video.classList.add('d-none');
        canvas.classList.remove('d-none');
        select("#captureButton").classList.add('d-none');

        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
        
        select("#keterangan").value = canvas.toDataURL("image/png");
        select("#captureButton").classList.add('d-none');
    }

    document.addEventListener("keydown", e => {
        if (e.key == "f") {
            capture();
        }
    });

    const changeStatus = status => {
        select("#keteranganArea").innerHTML = "";
        let toCreate = "init";
        if (status == "Jual") {
            toCreate = `<div class="mt-2">Info Pembeli :</div>
<textarea class="box" name="keterangan" required></textarea>`;
        }else {
            toCreate = `<div class="mt-2">Foto :</div>
<input type="text" class="d-none box" id="keterangan" name="keterangan">
<canvas id="cameraResult" class="d-none mt-1"></canvas>
<video id="camera" class="mt-1"></video>
<div class="bagi bagi-2"><button type="button" class='lebar-100 mt-2' id="captureButton" onclick="capture()">Capture</button></div>
<div class="bagi bagi-2"><button type="button" class='lebar-100 mt-2' onclick="startCamera()" style='border: none;'>Ulangi</button></div>`;
            setTimeout(() => {
                startCamera();
            }, 500);
        }
        createElement({
            el: 'div',
            html: toCreate,
            createTo: "#keteranganArea"
        });
    }
</script>
@endsection