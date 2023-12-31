@extends('layouts.app')

@section('title', 'Berita Acara Pembayaran (BAPH)')

@section('content')
<div class="container-fluid">
    <h1>Berita Acara Pembayaran (BAPH)</h1>
                <!-- Display session success message if available -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    <form action="{{ route('PembantuPPTKView.baph.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="dpa_id" value="{{ $dpaId }}">
        <div class="form-group">
        <label for="dpa_id">DPA:</label>
        <select name="dpa_id" id="dpa_id" class="form-control" required disabled>
            @foreach($dpas as $dpa)
                <option value="{{ $dpa->id }}" {{ request()->query('dpaId') == $dpa->id ? 'selected' : '' }}>
                    {{ $dpa->nomor_dpa }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nomor">Nomor:</label>
            <input type="text" name="nomor" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="tanggal">Tanggal:</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan:</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="upload_dokumen">Upload Dokumen:</label>
            <input type="file" name="upload_dokumen" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>
@endsection
