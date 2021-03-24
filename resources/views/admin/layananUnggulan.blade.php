@extends('layouts.admin')

@section('title', "Jadwal dan Info Layanan Unggulan")

@section('head.dependencies')
<style>
    #coverPreview {
        line-height: 200px;
        border: 1px solid #ddd;
        border-radius: 6px;
        background-color: #ddd;
        margin-top: 10px;
        text-align: center;
    }
    .cover {
        height: 220px;
        border-top-left-radius: 6px;
        border-top-right-radius: 6px;
    }
    .layanan-item:hover #controlArea { opacity: 1; }
</style>
@endsection

@section('content')
<div class="bagi bagi-2">
    <form action="{{ route('admin.layananUnggulan') }}">
        <div>Cari Layanan :</div>
        <input type="text" class="box" name="q" value="{{ $req->q }}">
        @if ($req->q != "")
            <a href="{{ route('admin.layananUnggulan') }}" id="clearDate"><i class="fas fa-times"></i></a>
        @endif
    </form>
</div>
<div class="bagi bagi-2 rata-kanan">
    <button class="biru mt-2" onclick="munculPopup('#addLayanan')">
        <i class="fas fa-plus mr-1"></i> Layanan Baru
    </button>
</div>
<br /><br />
@foreach ($datas as $data)
    @php
        $jadwal = json_decode($data->jadwal);
        $firstDay = $jadwal[0][0];
        $lastDay = $jadwal[count($jadwal) - 1][0];
        $time = explode("-", $jadwal[0][1]);
        $startTime = $time[0];
        $endTime = $time[1];
        $escapedData = str_replace('"', '\"', $data);
    @endphp
    <div class="bagi bagi-3">
        <div class="wrap">
            <div class="bg-putih rounded bayangan-5 layanan-item">
                <div class="cover" bg-image="{{ asset('storage/foto_layanan_unggulan/'.$data->foto) }}"></div>
                <div class="smallPadding">
                    <div class="wrap super">
                        <h3>{{ $data->nama }}
                            <div id="controlArea" class="ke-kanan teks-kecil transparan">
                                <span onclick="edit('{{ $escapedData }}')" class="teks-hijau mr-1 pointer">
                                    <i class="fas fa-edit"></i>
                                </span>
                                <a href="{{ route('admin.layananUnggulan.delete', $data->id) }}" onclick="return confirm('Yakin ingin menghapus data layanan ini?')" class="teks-merah">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </h3>
                        <div class="teks-transparan bagi pr-1 border-right-2">{{ $firstDay }} - {{ $lastDay }}</div>
                        <div class="teks-transparan bagi ml-1">{{ $startTime }} - {{ $endTime }}</div>
                        <div class="teks-transparan mt-2">{{ $data->alamat }}</div>
                        <div class="teks-transparan mt-1">{{ $data->phone }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

<div class="bg"></div>
<div class="popupWrapper" id="addLayanan">
    <div class="popup">
        <div class="wrap">
            <h3>Tambah Layanan Unggulan
                <i class="fas fa-times ke-kanan pointer" onclick="hilangPopup('#addLayanan')"></i>
            </h3>
            <form action="{{ route('admin.layananUnggulan.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="mt-2">Kategori :</div>
                <select name="category" class="box">
                    <option>Corner</option>
                    <option>Samling</option>
                    <option>Payment Point</option>
                    <option value="other">Lainnya</option>
                </select>
                <div class="mt-2">Nama :</div>
                <input type="text" class="box" name="nama" placeholder="contoh : SAMLING Grand City" required>
                <div class="mt-2">Alamat :</div>
                <input type="text" class="box" name="alamat" required>
                <div class="mt-2">Foto Cover :</div>
                <div id="coverPreview" onclick="chooseFile()">KLIK UNTUK UPLOAD FOTO</div>
                <input type="file" class="box d-none" onchange="processPhoto(this)" id="choosePhoto" name="foto" required>
                <div class="mt-2">Kontak :</div>
                <input type="text" class="box" name="phone" required placeholder="No. Telepon / WhatsApp">
                <div class="mt-2">Jadwal :</div>
                <div id="jadwalArea">
                    <div>
                        <div class="bagi bagi-2">
                            <div class="mt-2">Hari :</div>
                            <input type="text" class="box" name="days[]" required placeholder="cth : Senin, Selasa, Rabu">
                        </div>
                        <div class="bagi bagi-2">
                            <div class="mt-2">Jam :</div>
                            <input type="text" class="box" name="times[]" required placeholder="cth : 08.00 - 16.00 / Tutup">
                        </div>
                    </div>
                </div>
                <button type="button" class="p-0 tinggi-40 mt-2 lebar-50 teks-kecil" onclick="addDay()">Tambahkan Hari</button>
                
                <button class="biru lebar-100 mt-3">Simpan</button>
            </form>
        </div>
    </div>
</div>

<div class="popupWrapper" id="editLayanan">
    <div class="popup">
        <div class="wrap">
            <h3>Edit Data Layanan
                <i class="fas fa-times ke-kanan pointer" onclick="hilangPopup('#editLayanan')"></i>
            </h3>
            <form action="{{ route('admin.layananUnggulan.update') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="data_id" id="data_id">
                <div class="mt-2">Kategori :</div>
                <select name="category" class="box">
                    <option value="Corner">Corner</option>
                    <option value="Samling">Samling</option>
                    <option value="Payment Point">Payment Point</option>
                    <option value="other">Lainnya</option>
                </select>
                <div class="mt-2">Nama :</div>
                <input type="text" class="box" id="nama" name="nama" placeholder="contoh : SAMLING Grand City" required>
                <div class="mt-2">Alamat :</div>
                <input type="text" class="box" name="alamat" id="alamat" required>
                <div class="mt-2">Foto Cover :</div>
                <div id="coverPreview" onclick="chooseFile(1)">KLIK UNTUK UPLOAD FOTO</div>
                <div class="teks-transparan mt-1">klik gambar di atas untuk mengganti foto</div>
                <input type="file" class="box d-none" onchange="processPhoto(this, 'isEdit')" id="choosePhotoEdit" name="foto">
                <div class="mt-2">Kontak :</div>
                <input type="text" class="box" id="phone" name="phone" required placeholder="No. Telepon / WhatsApp">
                <div class="mt-2">Jadwal :</div>
                <div id="jadwalArea"></div>
                <button type="button" class="p-0 tinggi-40 mt-2 lebar-50 teks-kecil" onclick="addDay('isEdit')">Tambahkan Hari</button>
                
                <button class="biru lebar-100 mt-3">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>

    const addDay = (isEdit = null) => {
        let createTo = isEdit == null ? "#addLayanan #jadwalArea" : "#editLayanan #jadwalArea";
        createElement({
            el: 'div',
            html: `<div class="bagi bagi-2">
        <div class="mt-2">Hari :</div>
        <input type="text" class="box" name="days[]" required placeholder="cth : Senin, Selasa, Rabu">
    </div>
    <div class="bagi lebar-40">
        <div class="mt-2">Jam :</div>
        <input type="text" class="box" name="times[]" required placeholder="cth : 08.00 - 16.00 / Tutup">
    </div>
    <div class="bagi lebar-10">
        <div class="mt-1">&nbsp;</div>
        <button class="merah mt-2 border-none p-0 lebar-100 tinggi-50" onclick="removeJadwal(this)" type="button"><i class="fas fa-times"></i></button>
    </div>`,
            createTo: createTo
        });
    }
    const removeJadwal = btn => {
        let toRemove = btn.parentNode.parentNode;
        toRemove.remove();
    }
    const chooseFile = (isEdit = null) => {
        let selector = isEdit == null ? "#choosePhoto" : "#choosePhotoEdit";
        select(selector).click();
    }
    const processPhoto = (input, isEdit = null) => {
        let file = input.files[0];
        let reader = new FileReader();
        let preview = isEdit == null ? select("#addLayanan #coverPreview") : select("#editLayanan #coverPreview");
        reader.readAsDataURL(file);

        reader.addEventListener("load", () => {
            preview.innerHTML = "&nbsp;";
            preview.setAttribute('bg-image', reader.result);
            bindDivWithImage();
        });
    }
    const edit = data => {
        data = JSON.parse(data);
        let coverPreview = select("#editLayanan #coverPreview");
        munculPopup("#editLayanan");
        select("#editLayanan #data_id").value = data.id;
        select("#editLayanan #nama").value = data.nama;
        select("#editLayanan #alamat").value = data.alamat;
        coverPreview.innerHTML = "&nbsp;";
        coverPreview.setAttribute('bg-image', `{{ asset('storage/foto_layanan_unggulan/${data.foto}') }}`);
        select("#editLayanan #phone").value = data.phone;
        bindDivWithImage();

        let jadwal = JSON.parse(data.jadwal);
        let i = 0;
        jadwal.forEach(jadwal => {
            let iPP = i++;
            let toRender = `<div class="bagi bagi-2">
            <div class="mt-2">Hari :</div>
            <input type="text" class="box" name="days[]" required value="${jadwal[0]}">
        </div>
        <div class="bagi lebar-40">
            <div class="mt-2">Jam :</div>
            <input type="text" class="box" name="times[]" required value="${jadwal[1]}">
        </div>`;
            if (iPP != 0) {
                toRender += `<div class="bagi lebar-10">
            <div class="mt-1">&nbsp;</div>
            <button class="merah mt-2 border-none p-0 lebar-100 tinggi-50" onclick="removeJadwal(this)" type="button"><i class="fas fa-times"></i></button>
        </div>`;
            }
            createElement({
                el: 'div',
                html: toRender,
                createTo: "#editLayanan #jadwalArea"
            });
        });
    }
</script>
@endsection