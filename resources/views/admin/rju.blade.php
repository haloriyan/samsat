@extends('layouts.admin')

@section('title', "Permohonan Menjadi Wajib Retribusi Jasa Usaha")

@php
    use Carbon\Carbon;
    $statuses = ["2" => "Pending", "1" => "Diterima", "0" => "Ditolak"];
@endphp

@section('content')
<div class="bagi bagi-2">
    <form action="{{ route('admin.rju') }}">
        <div class="mt-2">Cari berdasarkan perusahaan :</div>
        <input type="text" class="box" name="company" placeholder="Nama perusahaan" value="{{ $req->company }}">
    </form>
</div>
<div class="bagi lebar-10"></div>
<div class="bagi lebar-40 mt-1">
    <div class="mt-1">Rentang Tanggal Data Dikirimkan :</div>
    <input type="text" class="box" id="dateFilter" onchange="filterDate(this.value)">
    @if ($req->start_date != "")
        <span id="clearDate" onclick="clearDate()"><i class="fas fa-times"></i></span>
    @endif
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
            <th>Dikirimkan pada</th>
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

<div class="mt-4">
    <div class="bagi lebar-70">
        {{ $datas->links('pagination::bootstrap-4') }}
    </div>
    <div class="bagi lebar-30">
        <button class="lebar-100 hijau" onclick="exportToCSV('{{ json_encode($datasToExport) }}', '{{ $generatedFileName }}')">
            Download Data
        </button>
    </div>
</div>
@endsection

@section('javascript')
<script>
    flatpickr("#dateFilter", {
        mode: "range",
        defaultDate: ["{{ $req->start_date }}", "{{ $req->end_date }}"]
    });

    let url = new URL(document.URL);

    const filterDate = value => {
        let date = value.split(' to ');
        let startDate = date[0];
        let endDate = date[1];

        if (endDate !== undefined) {
            url.searchParams.set('start_date', startDate);
            url.searchParams.set('end_date', endDate);
            url.searchParams.delete('page');
            window.location = url.toString();
        }
    }
    const clearDate = () => {
        url.searchParams.delete('start_date');
        url.searchParams.delete('end_date');
        window.location = url.toString();
    }
</script>
@endsection