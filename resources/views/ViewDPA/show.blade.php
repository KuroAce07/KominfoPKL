@extends('layouts.app')

@section('title', 'Sub DPA Details')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sub DPA</h1>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')
    
    <!-- Display Sub Kegiatan -->
    @foreach ($dpa->subDPA as $index => $sub_dpa)
        @php
            $subkegiatan = $sub_dpa->sub_kegiatan;
            $kodeRekeningLines = explode("\n", $sub_dpa->kode_rekening);
            $uraianLines = explode("\n", $sub_dpa->uraian);
            $koefisienLines = explode("\n", $sub_dpa->koefisien);
            $satuanLines = explode("\n", $sub_dpa->satuan);
            $hargaLines = explode("\n", $sub_dpa->harga);
            $jumlahLines = explode("\n", $sub_dpa->jumlah);
            $sumberDana = $sub_dpa->sumber_dana;
            $jenisbarang = $sub_dpa->jenis_barang;
            $maxRows = max(count($kodeRekeningLines), count($uraianLines), count($koefisienLines), count($satuanLines), count($hargaLines), count($jumlahLines));
        @endphp
        
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Sub Kegiatan : {{ $subkegiatan }}</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
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
                            <!-- Loop through rows for the current subDPA -->
                            @for ($rowIndex = 0; $rowIndex < $maxRows; $rowIndex++)
                                <tr>
                                    <td>{{ $kodeRekeningLines[$rowIndex] ?? '' }}</td>
                                    <td>
                                        @if ($rowIndex === (count($jumlahLines) - 1) && $sumberDana !== null)
                                            <strong>[#]</strong>
                                            <br>
                                            {!! nl2br(e($sumberDana)) !!}
                                        @endif
                                        {{ $uraianLines[$rowIndex] ?? '' }}
                                    </td>
                                    <td>{{ $koefisienLines[$rowIndex] ?? '' }}</td>
                                    <td>{{ $satuanLines[$rowIndex] ?? '' }}</td>
                                    <td>{{ $hargaLines[$rowIndex] ?? '' }}</td>
                                    <td>0</td>
                                    <td>{{ $jumlahLines[$rowIndex] ?? '' }}</td>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
