@extends('layouts.app')

@section('title', 'Sub DPA Details')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sub DPA Details</h1>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')
   
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
                                <th>Uraian and Rincian Perhitungan</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dpa->subDPA as $sub_dpa)
                                @php
                                    $kodeRekeningLines = explode("\n", $sub_dpa->kode_rekening);
                                    $uraianLines = explode("\n", $sub_dpa->uraian);
                                    $jumlahLines = explode("\n", $sub_dpa->jumlah);
                                    $rincianPerhitunganLines = explode("\n", $sub_dpa->rincian_perhitungan);
                                    $maxRows = max(count($kodeRekeningLines), count($uraianLines), count($jumlahLines), count($rincianPerhitunganLines));
                                @endphp

                                @for ($index = 0; $index < $maxRows; $index++)
                                    <tr>
                                        <td>{{ $kodeRekeningLines[$index] ?? '' }}</td>
                                        <td>
                                            {{ $uraianLines[$index] ?? '' }}
                                            <br>
                                            {{ $rincianPerhitunganLines[$index] ?? '' }}
                                        </td>
                                        <td>{{ $jumlahLines[$index] ?? '' }}</td>
                                    </tr>
                                @endfor
                            @endforeach
                        </tbody>
                    </table>
                    <p><strong>Jenis Barang:</strong> {!! nl2br(e($dpa->subDPA[0]->jenis_barang)) !!}</p>
                @else
                    <p>No Sub DPA available for this entry.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
