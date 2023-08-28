<!-- resources/views/form/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <form action="{{ route('pengadaan.store_pengadaan') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="dpa_id" value="{{ $dpa_id }}">
            <label for="pilihan">Pilih Jenis Dokumen:</label>
            <select name="pilihan" id="pilihan">
                <option value="Kontrak">Kontrak</option>
                <option value="Pemesanan">Pemesanan</option>
                <option value="E-Purchasing">E-Purchasing</option>
                <option value="E-Purchasing">Lainnya</option>
                <!-- Tambahkan pilihan lainnya sesuai kebutuhan -->
            </select>
            <br>
            <label for="keterangan">Keterangan:</label>
            <textarea name="keterangan" id="keterangan" rows="4" cols="50"></textarea>
            <br>
            <label for="berkas">Berkas:</label>
            <input type="file" name="berkas" id="berkas">
            <br>
            <button type="submit">Submit</button>
        </form>
    </div>
@endsection
