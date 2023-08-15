@extends('layouts.app')

@section('title', 'Sub DPA Details')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sub DPA Details</h1>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')
     <!-- Display Sub Kegiatan -->
     @if (count($dpa->subDPA) > 0)
        @php
            $subkegiatan = $dpa->subDPA[0]->sub_kegiatan;
        @endphp
        <p><strong>Sub Kegiatan:</strong> {{ $subkegiatan }}</p>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sub DPA Details</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (count($dpa->subDPA) > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Kode Rekening</th>
                                <th>Uraian</th>
                                <th>Koefisien</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th>PPN</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dpa->subDPA as $sub_dpa)
                                @php
                                    $subkegiatan = $sub_dpa->sub_kegiatan;
                                    $kodeRekeningLines = explode("\n", $sub_dpa->kode_rekening);
                                    $uraianLines = explode("\n", $sub_dpa->uraian);
                                    $rincianPerhitunganLines = explode("\n", $sub_dpa->rincian_perhitungan);
                                    $jumlahLines = explode("\n", $sub_dpa->jumlah);
                                    $sumberDana = $sub_dpa->sumber_dana;
                                    $jenisbarang = $sub_dpa->jenis_barang;
                                    $koefisienLines = explode("\n", $sub_dpa->koefisien);
                                    $satuanLines = explode("\n", $sub_dpa->satuan);
                                    $hargaLines = explode("\n", $sub_dpa->harga);
                                    $maxRows = max(count($kodeRekeningLines), count($uraianLines), count($rincianPerhitunganLines), count($jumlahLines));
                                @endphp

                                @for ($index = 0; $index < $maxRows; $index++)
                                    <tr>
                                        <td>{{ $kodeRekeningLines[$index] ?? '' }}</td>
                                        <td>
                                            @if ($index === (count($jumlahLines) - 1) && $sumberDana !== null)
                                                <strong>[#]</strong>
                                                <br>
                                                {!! nl2br(e($sumberDana)) !!}
                                            @endif
                                            {{ $uraianLines[$index] ?? '' }}
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{ $jumlahLines[$index] ?? '' }}</td>
                                    </tr>
                                @endfor

                                <!-- Add a new row for jenis_barang -->
                                <tr>
                                    <td></td>
                                    <td><strong></strong> {!! nl2br(e($jenisbarang)) !!}</td>
                                    <td>{{ $koefisienLines[count($koefisienLines) - 1] ?? '' }}</td>
                                    <td>{{ $satuanLines[count($satuanLines) - 1] ?? '' }}</td>
                                    <td>{{ $hargaLines[count($hargaLines) - 1] ?? '' }}</td>
                                    <td>0</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No Sub DPA available for this entry.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
