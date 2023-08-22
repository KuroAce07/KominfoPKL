@extends('layouts.app')

@section('content')
    <h1>Create Document</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nama_dokumen">Nama Dokumen</label>
            <input type="text" class="form-control" id="nama_dokumen" name="nama_dokumen" required>
        </div>
        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <input type="text" class="form-control" id="keterangan" name="keterangan" required>
        </div>
        <div class="form-group">
            <label for="tipe_dokumen">Tipe Dokumen</label>
            <select class="form-control" id="tipe_dokumen" name="tipe_dokumen" required>
                <option value="Berita Acara Pembayaran">Berita Acara Pembayaran</option>
                <option value="Kwitansi">Kwitansi</option>
                <option value="BAST">BAST</option>
                <option value="Berita Acara Pemeriksaan">Berita Acara Pemeriksaan</option>
                <option value="Surat Pertanggung Jawaban Belanja">Surat Pertanggung Jawaban Belanja</option>
            </select>
        </div>
        <div class="form-group">
            <label for="file">File</label>
            <input type="file" class="form-control" id="file" name="file" accept=".pdf,.doc,.docx" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
