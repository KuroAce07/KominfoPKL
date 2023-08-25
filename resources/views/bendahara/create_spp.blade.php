<!-- resources/views/form/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <form action="{{ route('bendahara.store_spp') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="dpa_id" value="{{ $dpa_id }}">
            <br>
            <label for="no_spp">Nomor SPP:</label>
            <input type="text" name="no_spp" id="no_spp" />
            <br>
            <label for="no_sptjmspp">Nomor SPTJM SPP:</label>
            <input type="text" name="no_sptjmspp" id="no_sptjmspp" />
            <br>
            <label for="ket_spp">Keterangan:</label>
            <textarea name="ket_spp" id="ket_spp" rows="4" cols="50"></textarea>
            <br>
            <label for="spp">Upload SPP:</label>
            <input type="file" name="spp" id="spp">
            <br>
            <label for="sptjmspp">Upload SPTJM SPP:</label>
            <input type="file" name="sptjmspp" id="sptjmspp">
            <br>
            <label for="verif_spp">Upload Verifikasi SPP:</label>
            <input type="file" name="verif_spp" id="verif_spp">
            <br>
            <button type="submit">Submit</button>
        </form>
    </div>
@endsection
