@extends('layouts.admin')

@section('title', "Pembayaran PKB Tahunan")

@php
    use Carbon\Carbon;
    setlocale(LC_TIME, 'id_ID');
    Carbon::setLocale('id');

    $i = ($datas->currentPage() - 1) * $datas->perPage() + 1;
@endphp

@section('content')
@if ($company != null)
    <h3 class="mb-4">
        Menampilkan data dari perusahaan <b>{{ $company->name }}</b>.
        <a href="{{ route('admin.pkb') }}" class="teks-biru">hilangkan filter</a>
    </h3>
@endif

<div class="bagi bagi-2">
    <form action="{{ route('admin.pkb') }}">
        <div class="mt-2">Cari berdasarkan perusahaan :</div>
        <input type="text" class="box" name="company" placeholder="Nama perusahaan" value="{{ $req->company }}">
    </form>
</div>
<div class="bagi lebar-10"></div>
<div class="bagi lebar-40 mt-1">
    <div class="mt-1">Rentang Tanggal Pembayaran :</div>
    <input type="text" class="box" id="dateFilter" onchange="filterDate(this.value)">
    @if ($req->start_date != "")
        <span id="clearDate" onclick="clearDate()"><i class="fas fa-times"></i></span>
    @endif
</div>

<table class="mt-4">
    <thead>
        <tr>
            <th>No</th>
            <th>Perusahaan</th>
            <th>Tanggal Pembayaran</th>
            <th>Nomor Polisi</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            @php
                $nopols = explode(",", $data->nopol);
            @endphp
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $data->company->name }}</td>
                <td>{{ Carbon::parse($data->payment_date)->isoFormat('D MMMM Y') }}</td>
                <td>
                    {{ count($nopols) }} nomor
                </td>
                <td>
                    <span class="bg-hijau p-1 pl-2 pr-2 rounded pointer" onclick="seeDetail('{{ $data }}')">
                        Detail
                    </span>
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

<div class="bg"></div>
<div class="popupWrapper" id="detail">
    <div class="popup">
        <div class="wrap">
            <h3>Detail
                <i class="fas fa-times ke-kanan pointer" onclick="hilangPopup('#detail')"></i>
            </h3>
            <form action="#">
                <div class="bagi bagi-2">
                    <div class="mt-2">Nama Perusahaan :</div>
                    <div class="mt-1 teks-tebal" id="companyName"></div>
                </div>
                <div class="bagi bagi-2">
                    <div class="mt-2">No. WhatsApp :</div>
                    <div class="mt-1 teks-tebal" id="companyPhone"></div>
                </div>
                <div class="bagi bagi-2">
                    <div class="mt-2">Alamat :</div>
                    <div class="mt-1 teks-tebal" id="companyAddress"></div>
                </div>
                <div class="bagi bagi-2">
                    <div class="mt-2">Tanggal Pembayaran :</div>
                    <div class="mt-1 teks-tebal" id="paymentDate"></div>
                </div>
                <div class="mt-2">Nomor Polisi :</div>
                <div id="nopolArea" class="mt-1"></div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    flatpickr("#dateFilter", {
        mode: "range",
        defaultDate: ["{{ $req->start_date }}", "{{ $req->end_date }}"]
    });

    const seeDetail = data => {
        data = JSON.parse(data);
        munculPopup("#detail");

        let paymentDate = moment(data.payment_date).locale('id').format("D MMMM YYYY");

        select("#detail #companyName").innerText = data.company.name;
        select("#detail #companyAddress").innerText = data.company.address;
        select("#detail #companyPhone").innerText = data.company.phone;
		select("#detail #paymentDate").innerText = paymentDate;
		select("#nopolArea").innerHTML = "";

        let nopols = data.nopol.split(',');
        nopols.forEach(nopol => {
            createElement({
                el: 'div',
                attributes: [
                    ['class', 'bagi bg-hitam rounded p-1 pl-2 pr-2 mr-1']
                ],
                html: nopol,
                createTo: '#nopolArea'
            });
        });
    }

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
