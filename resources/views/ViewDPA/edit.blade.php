@extends('layouts.app')

@section('title', 'Edit DPA')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit DPA</h1>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit DPA</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('updateDPA', ['dpa' => $dpa->id]) }}" method="post">
                @csrf
                @method('PUT')

                {{-- Your form fields and inputs go here --}}
                <div class="form-group">
                    <label for="nomor_dpa">Nomor DPA</label>
                    <input type="text" class="form-control" id="nomor_dpa" name="nomor_dpa" value="{{ $dpa->nomor_dpa }}">
                </div>

                <!-- Additional Data Display -->
                <div class="form-group">
                    <label for="urusan_pemerintahan">Urusan Pemerintahan</label>
                    <input type="text" class="form-control" id="urusan_pemerintahan" name="urusan_pemerintahan" value="{{ $dpa->urusan_pemerintahan }}" >
                </div>
                <div class="form-group">
                    <label for="bidang_urusan">Bidang Urusan</label>
                    <input type="text" class="form-control" id="bidang_urusan" name="bidang_urusan" value="{{ $dpa->bidang_urusan }}" >
                </div>
                <div class="form-group">
                    <label for="program">Program</label>
                    <input type="text" class="form-control" id="program" name="program" value="{{ $dpa->program }}" >
                </div>
                <div class="form-group">
                    <label for="kegiatan">Kegiatan</label>
                    <input type="text" class="form-control" id="kegiatan" name="kegiatan" value="{{ $dpa->kegiatan }}" >
                </div>
                <div class="form-group">
                    <label for="dana">Dana Yang Dibutuhkan</label>
                    <input type="text" class="form-control" id="dana" name="dana" value="{{ $dpa->dana }}" >
                </div>
                <div class="form-group">
    <label for="pptk">PPTK</label>
    @if ($dpa->assignedUser)
        <select class="form-control" id="pptk" name="pptk">
            <option value="{{ $dpa->assignedUser->id }}" selected>
                {{ $dpa->assignedUser->first_name }} {{ $dpa->assignedUser->last_name }}
            </option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">
                    {{ $user->first_name }} {{ $user->last_name }}
                </option>
            @endforeach
        </select>
    @else
        <div class="btn-group">
            <button type="button" class="btn btn-secondary dropdown-toggle assign-btn" data-toggle="dropdown">
                Assign
            </button>
            <div class="dropdown-menu">
                @foreach ($users as $user)
                    <a class="dropdown-item" href="{{ route('ViewDPA.assignDpa', ['dpaId' => $dpa->id, 'userId' => $user->id]) }}">
                        {{ $user->first_name }} {{ $user->last_name }}
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>


                {{-- Submit button --}}
                <button type="submit" class="btn btn-primary">Update DPA</button>
            </form>
        </div>
    </div>
</div>
@endsection
