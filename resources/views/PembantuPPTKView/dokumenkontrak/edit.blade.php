@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Dokumen Kontrak</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('PembantuPPTKView.dokumenkontrak.update', ['id' => $dokumenKontrak->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
                <label for="dpa_id">DPA:</label>
                <select name="dpa_id" id="dpa_id" class="form-control" required>
                    @foreach($dpas as $dpa)
                        <option value="{{ $dpa->id }}" {{ $dokumenKontrak->dpa_id == $dpa->id ? 'selected' : '' }}>{{ $dpa->nomor_dpa }}</option>
                    @endforeach
                </select>
            </div>

        <div class="form-group">
            <label for="jenis_kontrak">Jenis Kontrak:</label>
            <select name="jenis_kontrak" id="jenis_kontrak" class="form-control" required>
                <option value="Kwitansi" {{ $dokumenKontrak->jenis_kontrak === 'Kwitansi' ? 'selected' : '' }}>Kwitansi</option>
                <option value="Nota/Bukti Pembelian/Invoice" {{ $dokumenKontrak->jenis_kontrak === 'Nota/Bukti Pembelian/Invoice' ? 'selected' : '' }}>Nota/Bukti Pembelian/Invoice</option>
                <option value="Surat Pemesanan" {{ $dokumenKontrak->jenis_kontrak === 'Surat Pemesanan' ? 'selected' : '' }}>Surat Pemesanan</option>
                <option value="Dokumen Kontrak (SPK)" {{ $dokumenKontrak->jenis_kontrak === 'Dokumen Kontrak (SPK)' ? 'selected' : '' }}>Dokumen Kontrak (SPK)</option>
                <option value="Surat Perjanjian" {{ $dokumenKontrak->jenis_kontrak === 'Surat Perjanjian' ? 'selected' : '' }}>Surat Perjanjian</option>
            </select>
        </div>

        <div class="form-group">
            <label for="nama_kegiatan_transaksi">Nama Kegiatan Transaksi:</label>
            <input type="text" name="nama_kegiatan_transaksi" class="form-control" value="{{ $dokumenKontrak->nama_kegiatan_transaksi }}" required>
        </div>

        <div class="form-group">
            <label for="tanggal_kontrak">Tanggal Kontrak:</label>
            <input type="date" name="tanggal_kontrak" class="form-control" value="{{ $dokumenKontrak->tanggal_kontrak }}" required>
        </div>

        <div class="form-group">
            <label for="jumlah_uang">Jumlah Uang:</label>
            <input type="number" name="jumlah_uang" class="form-control" step="0.01" value="{{ $dokumenKontrak->jumlah_uang }}" required>
        </div>

        <div class="form-group">
            <label for="ppn">PPN:</label>
            <input type="number" name="ppn" class="form-control" step="0.01" value="{{ $dokumenKontrak->ppn }}">
        </div>

        <div class="form-group">
            <label for="pph">PPH:</label>
            <input type="number" name="pph" class="form-control" step="0.01" value="{{ $dokumenKontrak->pph }}">
        </div>

        <div class="form-group">
            <label for="jumlah_potongan">Jumlah Potongan:</label>
            <input type="number" name="jumlah_potongan" class="form-control" step="0.01" value="{{ $dokumenKontrak->jumlah_potongan }}">
        </div>

        <div class="form-group">
            <label for="jumlah_total">Jumlah Total:</label>
            <input type="number" name="jumlah_total" class="form-control" step="0.01" value="{{ $dokumenKontrak->jumlah_total }}" required>
        </div>

        <div class="form-group">
            <label for="keterangan">Keterangan:</label>
            <textarea name="keterangan" class="form-control">{{ $dokumenKontrak->keterangan }}</textarea>
        </div>

        <div class="form-group">
            <label for="upload_dokumen">Upload Dokumen:</label>
            <input type="file" name="upload_dokumen" class="form-control-file">
        </div>

        @if (auth()->user()->hasRole('Pembantu PPTK'))
                <input type="hidden" name="approval" value="0">
                <input type="hidden" name="reject" value="0">
            @else
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="approval" name="approval">
                    <label class="form-check-label" for="approval">Approve</label>
                </div>

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="reject" name="reject">
                    <label class="form-check-label" for="reject">Reject</label>
                </div>
            @endif

            <button type="submit" class="btn btn-primary">Update Dokumen Kontrak Data</button>
        </form>
    </div>
@endsection
