@extends('layouts.app')

@section('title', 'Edit Berkas')

@section('content')
<div class="container">
    <h2>Edit Berkas</h2>

    @include('common.alert')

    <form action="{{ route('pengadaan.update', ['id' => $berkas->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_rekanan">Pilih Rekanan:</label>
            <select class="form-control" name="nama_rekanan" id="nama_rekanan">
                @foreach ($rekanans as $rekanan)
                <option value="{{ $rekanan->nama_rekanan }}">{{ $rekanan->nama_rekanan }}</option>
                @endforeach
                <!-- Tambahkan pilihan lainnya sesuai kebutuhan -->
            </select>
        </div>

        <div class="form-group">
            <label for="pilihan">Pilih Jenis Dokumen:</label>
            <select class="form-control" name="pilihan" id="pilihan">
                <option value="Kontrak">Kontrak</option>
                <option value="Pemesanan">Pemesanan</option>
                <option value="E-Purchasing">E-Purchasing</option>
                <option value="Lainnya">Lainnya</option>
                <!-- Tambahkan pilihan lainnya sesuai kebutuhan -->
            </select>
        </div>

        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <input type="text" name="keterangan" class="form-control" value="{{ $berkas->keterangan }}">
        </div>

        <!-- Tambahkan field lain sesuai kebutuhan -->

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
