@extends('layouts.app')

@section('title', 'Realisasi RAK')

@section('content')
{{-- FIRST SECTION --}}
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Rencana Anggaran Kas</h1>
    </div>

    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Rencana Anggaran Kas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Nomor</th>
                            <td>{{ $dpa->id }}</td>
                        </tr>
                        <tr>
                            <th>Nama Kegiatan</th>
                            <td>{{ $dpa->nama_kegiatan }}</td>
                        </tr>
                        <tr>
                            <th>Sub Kegiatan</th>
                            <td>{{ $dpa->nama_sub_kegiatan }}</td>
                        </tr>
                        <tr>
                            <th>Nama Akun</th>
                            <td>{{ $dpa->nama_akun }}</td>
                        </tr>
                        @for ($i = 1; $i <= 12; $i++)
                            @php
                                $bulanValue = "bulan_$i";
                                $formattedValue = number_format($dpa->$bulanValue, 0, ',', '.');
                            @endphp
                            @if ($dpa->$bulanValue != 0)
                                <tr>
                                    <th>Bulan {{ $i }}</th>
                                    <td>Rp. {{ $formattedValue }}</td>
                                </tr>
                            @endif
                        @endfor
                        <tr>
                            <th>Total RAK</th>
                            <td>Rp. {{ number_format($dpa->total_rak, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- SECOND SECTION --}}

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Realisasi RAK</h1>
    </div>

    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Realisasi Rencana Anggaran Kas</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('ViewDPA.updateRealisasi', $dpa->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="dpa_id" value="{{ $dpa->id }}">
            
                @for ($i = 1; $i <= 12; $i++)
                    @php
                        $bulanValue = "bulan_$i";
                        $formattedValue = number_format($dpa->$bulanValue);
                    @endphp
                    <div class="form-group">
                        <label for="bulan_{{ $i }}">Bulan {{ $i }}</label>
                        <input type="text" class="form-control" id="bulan_{{ $i }}" name="bulan_{{ $i }}"
                               value="{{ old('bulan_' . $i, $realisasi->$bulanValue ?? '') }}">
                    </div>
                @endfor
            
                <div class="form-group">
                    <label for="total_rak">Total RAK</label>
                    <input type="text" class="form-control" id="total_rak" name="total_rak"
                           value="{{ old('total_rak', $realisasi->total_rak ?? '') }}">
                </div>
            
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
            
        </div>
    </div>
</div>
@endsection
