@extends('layouts.app')

@section('content')
    <h1>Edit Document</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('documents.update', $document->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_dokumen">Nama Dokumen</label>
            <input type="text" class="form-control" id="nama_dokumen" name="nama_dokumen" value="{{ $document->nama_dokumen }}" required>
        </div>
        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $document->tanggal }}" required>
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ $document->keterangan }}" required>
        </div>
        <div class="form-group">
            <label for="tipe_dokumen">Tipe Dokumen</label>
            <select class="form-control" id="tipe_dokumen" name="tipe_dokumen" required>
                <option value="Berita Acara Pembayaran" {{ $document->tipe_dokumen === 'Berita Acara Pembayaran' ? 'selected' : '' }}>Berita Acara Pembayaran</option>
                <option value="Kwitansi" {{ $document->tipe_dokumen === 'Kwitansi' ? 'selected' : '' }}>Kwitansi</option>
                <option value="BAST" {{ $document->tipe_dokumen === 'BAST' ? 'selected' : '' }}>BAST</option>
                <option value="Berita Acara Pemeriksaan" {{ $document->tipe_dokumen === 'Berita Acara Pemeriksaan' ? 'selected' : '' }}>Berita Acara Pemeriksaan</option>
                <option value="Surat Pertanggung Jawaban Belanja" {{ $document->tipe_dokumen === 'Surat Pertanggung Jawaban Belanja' ? 'selected' : '' }}>Surat Pertanggung Jawaban Belanja</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
