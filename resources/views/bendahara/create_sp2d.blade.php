<!-- resources/views/form/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <form action="{{ route('bendahara.store_sp2d') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="dpa_id" value="{{ $dpa_id }}">
            <br>
            <label for="no_sp2d">Nomor SP2D:</label>
            <input type="text" name="no_sp2d" id="no_sp2d" />
            <br>
            <label for="tanggal">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            <br>
            <label for="ket_sp2d">Keterangan:</label>
            <textarea name="ket_sp2d" id="ket_sp2d" rows="4" cols="50"></textarea>
            <br>
            <label for="sp2d">Upload SP2D:</label>
            <input type="file" name="sp2d" id="sp2d">
            <br>
            <button type="submit">Submit</button>
        </form>
    </div>
@endsection
