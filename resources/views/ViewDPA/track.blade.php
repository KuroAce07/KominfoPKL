@extends('layouts.app')

@section('title', 'DPA List')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tracking DPA</h1>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DAFTAR DPA</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nomor DPA</th>
                            <th>Kegiatan</th>
                            <th>Progress</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dpaData as $dpa)
                            <tr>
                                <td>{{ $dpa->nomor_dpa }}</td>
                                <td>{{ $dpa->kegiatan }}</td>
                                <td>
                                    @if ($dpa->user_id4)
                                        Dikerjakan Oleh Bendahara
                                    @elseif ($dpa->user_id3)
                                        Dikerjakan Oleh PPTK Dan Sudah Diverifikasi oleh Penjabat Pengadaan
                                    @elseif ($dpa->user_id2)
                                        Dikerjakan Oleh Penjabat Pengadaan
                                    @elseif ($dpa->user_id)
                                        Dikerjakan Oleh PPTK
                                    @else
                                        Not Assigned
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
@endsection
