@extends('layouts.app')

@section('title', 'Roles')

@section('content')
<div class="container-fluid">

    <div class="panel panel-primary">
        <div class="panel-body">

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            <form action="{{ route('UploadDPA.index') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="inputFile">File:</label>
                    <input 
                        type="file" 
                        name="file" 
                        id="inputFile"
                        class="form-control @error('file') is-invalid @enderror">
                    @error('file')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Upload</button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
