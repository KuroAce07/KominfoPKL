<!-- resources/views/form/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <form action="{{ route('bendahara.store_spm') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="dpa_id" value="{{ $dpa_id }}">
            <br>
            <label for="no_spm">Nomor SPM:</label>
            <input type="text" name="no_spm" id="no_spm">
            <br>
            <label for="no_sptjmspm">Nomor SPTJM SPM:</label>
            <input type="text" name="no_sptjmspm" id="no_sptjmspm">
            <br>
            <label for="spm">Upload SPM:</label>
            <input type="file" name="spm" id="spm">
            <br>
            <label for="sptjmspm">Upload SPTJM SPM:</label>
            <input type="file" name="sptjmspm" id="sptjmspm">
            <br>
            <label for="lampiran_sumber_dana">Upload Lampiran Sumber Dana:</label>
            <input type="file" name="lampiran_sumber_dana" id="lampiran_sumber_dana">
            <br>
            <button type="submit">Submit</button>
        </form>
    </div>
@endsection
