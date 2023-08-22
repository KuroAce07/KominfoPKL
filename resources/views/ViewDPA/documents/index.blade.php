@extends('layouts.app')

@section('content')
    <h1>Documents</h1>

    <a href="{{ route('documents.create') }}" class="btn btn-primary">Add Document</a>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th scope="col">Nama Dokumen</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Tipe Dokumen</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($documents as $document)
                <tr>
                    <td>{{ $document->nama_dokumen }}</td>
                    <td>{{ $document->tanggal }}</td>
                    <td>{{ $document->keterangan }}</td>
                    <td>{{ $document->tipe_dokumen }}</td>
                    <td>
                        <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('documents.destroy', $document->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                        @if ($document->file_path)
                            <a href="{{ route('documents.download', $document) }}" class="btn btn-primary">
                                Download
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
