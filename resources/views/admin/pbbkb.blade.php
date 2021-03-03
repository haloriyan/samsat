@extends('layouts.admin')

@section('title', "Pajak Bahan Bakar Kendaraan Bermotor")

@php
    $statuses = ["2" => "Pending", "1" => "Diterima", "0" => "Ditolak"];
@endphp

@section('content')
<div class="bagi bagi-2">
    <form action="{{ route('admin.pbbkb') }}">
        <div class="mt-2">Cari berdasarkan perusahaan :</div>
        <input type="text" class="box" name="company" placeholder="Nama perusahaan" value="{{ $req->company }}">
    </form>
</div>
<div class="bagi lebar-20"></div>
<div class="bagi lebar-30">
    <form action="{{ route('admin.pbbkb') }}">
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

<table class="mt-3">
    <thead>
        <tr>
            <th>Perusahaan</th>
            <th>Alamat</th>
            <th>NPWP</th>
            <th>No. WhatsApp</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            @php
                if ($data->status == 2) {
                    $displayStatus = "<span class='bg-kuning rounded p-1 pl-2 pr-2'>Pending</span>";
                }else if ($data->status == 1) {
                    $displayStatus = "<span class='bg-hijau rounded p-1 pl-2 pr-2'>Disetujui</span>";
                }else if ($data->status == 0) {
                    $displayStatus = "<span class='bg-merah rounded p-1 pl-2 pr-2'>Ditolak</span>";
                }
            @endphp
            <tr>
                <td>{{ $data->company->name }}</td>
                <td>{{ $data->company->address }}</td>
                <td>{{ $data->company->npwp }}</td>
                <td>{{ $data->company->phone }}</td>
                <td>{!! $displayStatus !!}</td>
                <td>
                    @if ($data->status == 2)
                        <a href="{{ route('admin.pbbkb.action', [$data->id, 1]) }}">
                            <span class='bg-hijau rounded p-1 pl-2 pr-2 mr-1'><i class="fas fa-check"></i></span>
                        </a>
                        <a href="{{ route('admin.pbbkb.action', [$data->id, 0]) }}">
                            <span class='bg-merah rounded p-1 pl-2 pr-2'><i class="fas fa-times"></i></span>
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('javascript')
<script>
    const filter = (type, value) => {
        let url = new URL(document.URL);
        url.searchParams.set(type, value);
        window.location = url.toString();
    }
</script>
@endsection