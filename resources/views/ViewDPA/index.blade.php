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
                                <td>{{ $index + 1 }}</td>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@foreach ($dpaData as $index => $dpa)
    <!-- Modal for Details -->
    <div class="modal fade" id="detailModal{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel{{ $index }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel{{ $index }}">Detail DPA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="mb-2"><strong>Nomor DPA:</strong> {{ $dpa->nomor_dpa }}</p>
                    <p class="mb-2"><strong>Urusan Pemerintahan:</strong> {{ $dpa->urusan_pemerintahan }}</p>
                    <p class="mb-2"><strong>Bidang Urusan:</strong> {{ $dpa->bidang_urusan }}</p>
                    <p class="mb-2"><strong>Program:</strong> {{ $dpa->program }}</p>
                    <p class="mb-2"><strong>Kegiatan:</strong> {{ $dpa->kegiatan }}</p>
                    <p class="mb-0"><strong>Dana Yang Dibutuhkan:</strong> 
                        @if (is_numeric($dpa->dana))
                            Rp{{ number_format(floatval($dpa->dana), 2, ',', '.') }}
                        @else
                            {{ $dpa->dana }}
                        @endif
                    </p>
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
</style>