@extends('layouts.admin')

@section('title', "Laporan Status Kendaraan Bermotor Perusahaan")

@section('content')
<div class="bagi bagi-2">
    <form action="{{ route('admin.kendaraanStatus') }}">
        <div class="mt-2">Cari berdasarkan perusahaan :</div>
        <input type="text" class="box" name="company" placeholder="Nama perusahaan" value="{{ $req->company }}">
        @if ($req->company != "")
            <a href="{{ route('admin.kendaraanStatus') }}">
                <span id="clearDate"><i class="fas fa-times"></i></span>
            </a>
        @endif
    </form>
</div>
<div class="bagi lebar-10"></div>
<div class="bagi lebar-40 mt-1 rata-kanan">
    <button class="hijau mt-3" onclick="exportToCSV('{{ json_encode($datasToExport) }}', '{{ $generatedFileName }}')">
        Download Data
    </button>
</div>

<table class="mt-4">
    <thead>
        <tr>
            <th>Nama Perusahaan</th>
            <th>Alamat Perusahaan</th>
            <th>No. WhatsApp</th>
            <th>Nomor Polisi</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            <tr>
                <td>{{ $data->company->name }}</td>
                <td>{{ $data->company->address }}</td>
                <td>{{ $data->company->phone }}</td>
                <td>{{ $data->nopol }}</td>
                <td>{{ $data->status }}</td>
                <td>
                    <span class="pointer rounded bg-hijau p-1 pl-2 pr-2" onclick="detail('{{ $data }}')">
                        Detail
                    </span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="bg"></div>
<div class="popupWrapper" id="detail">
    <div class="popup">
        <div class="wrap">
            <h3>Detail
                <i class="fas fa-times ke-kanan pointer" onclick="hilangPopup('#detail')"></i>
            </h3>
            <div>
                <div class="bagi bagi-2">
                    <div class="mt-2">Nama Perusahaan :</div>
                    <div class="mt-1 teks-tebal" id="companyName"></div>
                </div>
                <div class="bagi bagi-2">
                    <div class="mt-2">No. Telepon Perusahaan :</div>
                    <div class="mt-1 teks-tebal" id="companyPhone"></div>
                </div>
                <div class="mt-2">Alamat Perusahaan :</div>
                <div class="mt-1 teks-tebal" id="companyAddress"></div>
                <div class="bagi bagi-2">
                    <div class="mt-2">Nomor Polisi :</div>
                    <div class="mt-1 teks-tebal" id="nopol"></div>
                </div>
                <div class="bagi bagi-2">
                    <div class="mt-2">Status :</div>
                    <div class="mt-1 teks-tebal" id="status"></div>
                </div>
                <div class="mt-2">Keterangan :</div>
                <div class="mt-1" id="keteranganArea"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    const detail = data => {
        data = JSON.parse(data);
        munculPopup("#detail");

        select("#detail #companyName").innerText = data.company.name;
        select("#detail #companyPhone").innerText = data.company.phone;
        select("#detail #companyAddress").innerText = data.company.address;
        select("#detail #nopol").innerText = data.nopol;
        select("#detail #status").innerText = data.status;
        select("#detail #keteranganArea").innerHTML = "";

        if (data.status != "Jual") {
            createElement({
                el: 'div',
                attributes: [
                    ['class', 'lebar-100 tinggi-300'],
                    ['bg-image', `{{ asset('storage/keterangan_status/${data.keterangan}') }}`]
                ],
                createTo: "#detail #keteranganArea"
            });
            bindDivWithImage();
        }else {
            select("#detail #keteranganArea").innerText = data.keterangan;
        }
    }
</script>
@endsection