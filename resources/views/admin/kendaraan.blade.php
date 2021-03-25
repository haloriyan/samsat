@extends('layouts.admin')

@section('title', "Data Kendaraan Bermotor Perusahaan")

@section('content')
<div class="bagi bagi-2">
    <form action="{{ route('admin.kendaraan') }}">
        <div class="mt-2">Cari berdasarkan perusahaan :</div>
        <input type="text" class="box" name="company" placeholder="Nama perusahaan" value="{{ $req->company }}">
        @if ($req->company != "")
            <a href="{{ route('admin.kendaraan') }}">
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
            <th>No. WhatsApp Perusahaan</th>
            <th>Nomor Polisi</th>
            <th>Nomor Rangka</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            <tr>
                <td>{{ $data->company->name }}</td>
                <td>{{ $data->company->address }}</td>
                <td>{{ $data->company->phone }}</td>
                <td>{{ $data->nopol }}</td>
                <td>{{ $data->nomor_rangka }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection