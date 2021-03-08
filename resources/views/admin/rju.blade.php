@extends('layouts.admin')

@section('title', "Retribusi Jasa Usaha")

@php
    use Carbon\Carbon;
    $statuses = ["2" => "Pending", "1" => "Diterima", "0" => "Ditolak"];
@endphp

@section('content')
<div class="bagi bagi-2">
    <form action="{{ route('admin.pap') }}">
        <div class="mt-2">Cari berdasarkan perusahaan :</div>
        <input type="text" class="box" name="company" placeholder="Nama perusahaan" value="{{ $req->company }}">
    </form>
</div>
<div class="bagi lebar-20"></div>
<div class="bagi lebar-30">
    <form action="{{ route('admin.pap') }}">
        <div class="mt-2">Status :</div>
        <select id="status" class="box" onchange="filter('status', this.value)">
            <option selected value="">Semua Data</option>
            @foreach ($statuses as $code => $status)
                @php
                    $isSelected = $code == $req->status && $req->status != "" ? 'selected' : '';
                @endphp
                <option {{ $isSelected }} value="{{ $code }}">{{ $status }}</option>
            @endforeach
        </select>
    </form>
</div>

@if ($company != null)
    <h3 class="mb-2 mt-4">
        Menampilkan data dari perusahaan <b>{{ $company->name }}</b>.
        <a href="{{ route('admin.rju') }}" class="teks-biru">hilangkan filter</a>
    </h3>
@endif

<table class="mt-3">
    <thead>
        <tr>
            <th>Perusahaan</th>
            <th>Nama Penanggung Jawab</th>
            <th>Alamat</th>
            <th>NPWP Penanggung Jawab</th>
            <th>No. WhatsApp</th>
            <th>Dibuat pada</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            <tr>
                <td>{{ $data->company->name }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->address }}</td>
                <td>{{ $data->npwp }}</td>
                <td>{{ $data->phone }}</td>
                <td>
                    {{ Carbon::parse($data->created_at)->format('d M Y H:i:s') }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection