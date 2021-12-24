@extends('layouts.admin')

@section('title', "Informasi Pembayaran")

@section('head.dependencies')
<style>
    button {
        border: none;
    }
</style>
@endsection
    
@section('content')
<div class="rata-kanan">
    <button class="hijau" onclick="munculPopup('#addPayment')">
        <i class="fas fa-plus mr-1"></i> Tambah Data
    </button>
</div>

@if ($message != "")
    <div class="bg-hijau-transparan rounded p-2 mt-3 mb-3">
        {{ $message }}
    </div>
@endif

@if ($payments->count() == 0)
    <h3 class="rata-tengah">Tidak ada data</h3>
@else
    <div class="tinggi-30"></div>
    @foreach ($payments as $payment)
        <div class="bagi bagi-3">
            <div class="wrap">
                <div class="bg-putih rounded bayangan-5 smallPadding">
                    <div class="wrap">
                        <div class="tinggi-100 rounded mb-3" bg-image="{{ asset('storage/payment_image/'.$payment->image) }}"></div>
                        <div class="bagi bagi-2">
                            <h3>{{ $payment->title }}</h3>
                        </div>
                        <div class="rata-kanan bagi bagi-2">
                            <button class="bg-hijau-transparan tinggi-50 pt-0 pb-0 rounded" onclick="edit('{{ $payment }}')">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="bg-merah-transparan tinggi-50 pt-0 pb-0 rounded" onclick="hapus('{{ $payment }}')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif


<div class="bg"></div>
<div class="popupWrapper" id="addPayment">
    <div class="popup">
        <div class="wrap">
            <h3>Tambah Informasi Pembayaran
                <i class="fas fa-times ke-kanan pointer" onclick="hilangPopup('#addPayment')"></i>
            </h3>
            <form action="{{ route('admin.payment.store') }}" method="POST" enctype="multipart/form-data" class="wrap super">
                {{ csrf_field() }}
                <div class="mt-2">Nama Pembayaran :</div>
                <input type="text" class="box" id="title" name="title" placeholder="Indomaret, Tokopedia, dll" required>
                <div class="mt-2">Link ke Pembayaran :</div>
                <input type="url" class="box" name="link" id="link" required>
                <div class="mt-2">Detail Instruksi :</div>
                <textarea name="instruction" id="instruction" class="box" style="height: 250px" required></textarea>
                <div class="mt-2">Gambar :</div>
                <input type="file" class="box" name="image" accept="image/*" required>

                <button class="hijau lebar-100 mt-3">Tambahkan</button>
            </form>
        </div>
    </div>
</div>

<div class="popupWrapper" id="editPayment">
    <div class="popup">
        <div class="wrap">
            <h3>Ubah Informasi Pembayaran
                <i class="fas fa-times ke-kanan pointer" onclick="hilangPopup('#editPayment')"></i>
            </h3>
            <form action="{{ route('admin.payment.update') }}" method="POST" enctype="multipart/form-data" class="wrap super">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id">
                <div class="mt-2">Nama Pembayaran :</div>
                <input type="text" class="box" id="title" name="title" placeholder="Indomaret, Tokopedia, dll" required>
                <div class="mt-2">Link ke Pembayaran :</div>
                <input type="url" class="box" name="link" id="link" required>
                <div class="mt-2">Detail Instruksi :</div>
                <textarea name="instruction" id="instruction" class="box" style="height: 250px" required></textarea>
                <div class="mt-2">Ubah Gambar :</div>
                <input type="file" class="box" name="image" accept="image/*">
                <div class="mt-1 teks-kecil teks-transparan">biarkan kosong jika tidak ingin mengganti gambar</div>

                <button class="hijau lebar-100 mt-3">Tambahkan</button>
            </form>
        </div>
    </div>
</div>

<div class="popupWrapper" id="deletePayment">
    <div class="popup">
        <div class="wrap">
            <h3>Hapus Informasi Pembayaran
                <i class="fas fa-times ke-kanan pointer" onclick="hilangPopup('#deletePayment')"></i>
            </h3>
            <form action="{{ route('admin.payment.delete') }}" method="POST" enctype="multipart/form-data" class="wrap super">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id">
                Yakin ingin menghapus pembayaran <span id="name"></span> ?

                <button class="merah lebar-100 mt-3">Ya, hapus</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    const hapus = data => {
        data = escapeJson(data);
        data = JSON.parse(data);
        munculPopup("#deletePayment");
        select("#deletePayment #id").value = data.id;
        select("#deletePayment #name").innerText = data.title;
    }
    const edit = data => {
        data = escapeJson(data);
        data = JSON.parse(data);
        munculPopup("#editPayment");
        select("#editPayment #id").value = data.id;
        select("#editPayment #title").value = data.title;
        select("#editPayment #link").value = data.link;
        select("#editPayment #instruction").value = data.instruction;
    }
</script>
@endsection