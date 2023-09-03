@extends('layouts.app')

@section('title', 'Dokumen Kontrak')

@section('content')
<div class="container-fluid">
    <h1>Dokumen Kontrak</h1>

    <!-- Display the details of a single Dokumen Kontrak entry -->
    <div class="card">
        <div class="card-header">
            Dokumen Kontrak Details
        </div>
        <div class="card-body">
            <p><strong>Nomor DPA:</strong> {{ $dokumenKontrak->dpa->kode_sub_kegiatan }}</p>
            <p><strong>Nama Kegiatan:</strong> {{ $dokumenKontrak->dpa->nama_sub_kegiatan }}</p>
            <p><strong>Jenis Kontrak:</strong> {{ $dokumenKontrak->jenis_kontrak }}</p>
            <p><strong>Nama Kegiatan Transaksi:</strong> {{ $dokumenKontrak->nama_kegiatan_transaksi }}</p>
            <p><strong>Tanggal Kontrak:</strong> {{ $dokumenKontrak->tanggal_kontrak }}</p>
            <p><strong>Jumlah Uang:</strong> {{ $dokumenKontrak->jumlah_uang }}</p>
            <p><strong>PPN:</strong> {{ $dokumenKontrak->ppn }}</p>
            <p><strong>PPH:</strong> {{ $dokumenKontrak->pph }}</p>
            <p><strong>Potongan Lain:</strong> {{ $dokumenKontrak->potongan_lain }}</p>
            <p><strong>Jumlah Potongan:</strong> {{ $dokumenKontrak->jumlah_potongan }}</p>
            <p><strong>Jumlah Total:</strong> {{ $dokumenKontrak->jumlah_total }}</p>
            <p><strong>Keterangan:</strong> {{ $dokumenKontrak->keterangan }}</p>
            <p><strong>Dokumen:</strong> <a href="{{ url('uploads/' . $dpaId . '/' . basename($dokumenKontrak->upload_dokumen)) }}" download>View Dokumen</a></p>
            <p><strong>Status Persetujuan:</strong>
                @if ($dokumenKontrak->approval === 1)
                    <span class="text-success">Dokumen Disetujui</span>
                @elseif ($dokumenKontrak->approval === 2)
                    <span class="text-danger">Dokumen Ditolak</span>
                @else
                    <span class="text-warning">Dokumen Belum Disetujui</span>
                @endif
            </p>
            <p><strong>Alasan:</strong> {{ $dokumenKontrak->alasan }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('PembantuPPTKView.dokumenkontrak.edit', ['id' => $dokumenKontrak->id]) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
</div>

<script>
  document.addEventListener("input", function(event) {
    if (event.target.matches(".number-input")) {
      const step = parseFloat(event.target.getAttribute("data-step")) || 1.0;
      const inputValue = event.target.value.replace(/\D/g, ''); // Remove non-numeric characters
      const formattedValue = inputValue.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
      event.target.value = formattedValue;
    }
  });
</script>

@endsection
