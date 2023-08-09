@extends('layouts.app')

@section('title', 'View DPA')

@section('content')
<div class="container">
    <h2 class="text-center mt-4">Daftar DPA</h2>
    @if (session('success'))
        <div class="alert alert-success alert-block mt-4">
            <strong>{{ session('success') }}</strong>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="table-responsive mt-4">
                <table class="table table-bordered custom-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nomor DPA</th>
                            <th>Urusan Pemerintahan</th>
                            <th>Bidang Urusan</th>
                            <th>Program</th>
                            <th>Kegiatan</th>
                            <th>Dana Yang Dibutuhkan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dpaData as $index => $dpa)
                            <tr class="clickable-row" data-toggle="modal" data-target="#detailModal{{ $index }}">
                                <td>{{ $dpa->id }}</td>
                                <td>{{ $dpa->nomor_dpa }}</td>
                                <td>{{ $dpa->urusan_pemerintahan }}</td>
                                <td>{{ $dpa->bidang_urusan }}</td>
                                <td>{{ $dpa->program }}</td>
                                <td>{{ $dpa->kegiatan }}</td>
                                <td>
                                    @if (is_numeric($dpa->dana))
                                        Rp{{ number_format(floatval($dpa->dana), 2, ',', '.') }}
                                    @else
                                        {{ $dpa->dana }}
                                    @endif
                                </td>
                                <td>
            <div class="btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                    Assign
                </button>
                <div class="dropdown-menu">
                    @foreach ($users as $user)
                        <a class="dropdown-item" href="{{ route('assignDpa', ['dpaId' => $dpa->id, 'userId' => $user->id]) }}">
                            {{ $user->first_name }} {{ $user->last_name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </td>
    </tr>
                            </tr>
                            
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@foreach ($dpaData as $dpa)
    <!-- Modal for Details -->
    <div class="modal fade" id="detailModal{{ $dpa->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel{{ $dpa->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel{{ $dpa->id }}">Detail DPA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (count($dpa->subDPA) > 0)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Kode Rekening</th>
                                    <th>Uraian</th>
                                    <th>Rincian Perhitungan</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dpa->subDPA as $sub_dpa)
                                    @php
                                        $kodeRekeningLines = explode("\n", $sub_dpa->kode_rekening);
                                        $uraianLines = explode("\n", $sub_dpa->uraian);
                                        $jumlahLines = explode("\n", $sub_dpa->jumlah);
                                        $maxRows = max(count($kodeRekeningLines), count($uraianLines), count($jumlahLines));
                                    @endphp

                                    @for ($index = 0; $index < $maxRows; $index++)
                                        <tr>
                                            <td>{{ $kodeRekeningLines[$index] ?? '' }}</td>
                                            <td>{{ $uraianLines[$index] ?? '' }}</td>
                                            <td></td>
                                            <td>{{ $jumlahLines[$index] ?? '' }}</td>
                                        </tr>
                                        @if ($index === (count($uraianLines) - 1))
                                            <tr>
                                                <td></td>
                                                <td colspan="3">
                                                    <strong>Sumber Dana:</strong><br>
                                                    {!! str_replace("\n", '<br>', $sub_dpa->sumber_dana) !!}
                                                </td>
                                            </tr>
                                        @endif
                                    @endfor
                                @endforeach
                            </tbody>
                        </table>
                        <p><strong>Jenis Barang:</strong> {!! str_replace("\n", '<br />', $dpa->subDPA[0]->jenis_barang) !!}</p>
                    @else
                        <p>No Sub DPA available for this entry.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection
<style>
    
    .custom-table {
        border: 1px solid #000 !important; /* Set the border color to black (#000) with !important */
        border-collapse: collapse; /* Collapse borders into a single line */
    }

    .custom-table thead tr th {
        font-size: 1.2rem;
        font-weight: bold;
        background-color: #f7f7f7;
        color: #333;
        text-align: center;
    }

    .custom-table tbody tr:hover {
        background-color: #f1f1f1;
        cursor: pointer;
    }

    /* Override Bootstrap's default styles for table border color */
    .table-bordered th,
    .table-bordered td {
        border-color: #000 !important; /* Set the border color to black (#000) with !important */
    }

    /* Style for the modal */
    .modal-content {
        border-radius: 0.5rem;
    }

    .modal-header {
        background-color: #007bff;
        color: #fff;
    }

    .modal-body {
        padding: 2rem;
    }

    .modal-title {
        font-size: 1.5rem;
    }

    .modal-body p {
        font-size: 1.1rem;
        line-height: 1.5;
    }

    .modal-body p strong {
        color: #007bff;
    }

    .modal-body p.mb-0 {
        margin-bottom: 0;
    }

    .modal-body p.mb-2 {
        margin-bottom: 0.5rem;
    }
    .separator-row td {
        border-bottom: 1px solid #ddd;
    }
    .table-bordered tr:not(:last-child) {
        border-bottom: 1px solid #dee2e6;
    }
    
    .grid-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-gap: 10px;
    }
    <style>
    .custom-table {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    .custom-table__column {
        flex: 1;
        padding: 10px;
        border: 1px solid #dee2e6;
    }

    .custom-table__column--uraian {
        flex-basis: 70%;
    }

    .custom-table__column--jumlah {
        flex-basis: 30%;
    }
</style>
</style>