@extends('layouts.app')

@section('title', 'Dokumen Pembantu PPTK')

@php
    $dpaId = request()->query('dpaId');
@endphp

@section('content')
<div class="container-fluid">
    <h1>Dokumen Pembantu PPTK</h1>

    <!-- Dokumen Kontrak Menu -->
    <div class="card mb-3">
        <div class="card-header">
            Dokumen Kontrak Menu
        </div>
        <div class="card-body text-center">
            <!-- First set of buttons -->
            @hasrole('Pembantu PPTK')
            <div class="row justify-content-center mb-3">
                <div class="col-md-6">
                    <a class="btn btn-primary btn-block" href="{{ route('PembantuPPTKView.dokumenkontrak.create', ['dpaId' => request()->query('dpaId')]) }}">
                        <i class="fas fa-file-alt"></i>
                        Tambah Dokumen Kontrak
                    </a>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.dokumenkontrak.show', ['dpaId' => request()->query('dpaId')]) }}">
                        <i class="fas fa-eye"></i>
                        View Dokumen Kontrak
                        
                    </a>
                </div>
            </div>
            @endhasrole
            @hasrole(['Bendahara', 'PPTK'])
            <div class="mb-3">
                <a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.dokumenkontrak.show', ['dpaId' => request()->query('dpaId')]) }}">
                    <i class="fas fa-eye"></i>
                    View Dokumen Kontrak
                </a>
            </div>
            @endhasrole
        </div>
    </div>

        <!-- Dokumen Pendukung -->
        <div class="card mb-3">
        <div class="card-header">
            Dokumen Pendukung Menu
        </div>
        <div class="card-body text-center">
            <!-- First set of buttons -->
            @hasrole('Pembantu PPTK')
            <div class="row justify-content-center mb-3">
                <div class="col-md-6">
                    <a class="btn btn-primary btn-block" href="{{ route('PembantuPPTKView.dokumenpendukung.create', ['dpaId' => request()->query('dpaId')]) }}">
                        <i class="fas fa-file-alt"></i>
                        Tambah Dokumen Pendukung
                    </a>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.dokumenpendukung.index', ['dpaId' => request()->query('dpaId')]) }}">
                        
                        <i class="fas fa-eye"></i>
                        View Dokumen Pendukung
                    </a>
                </div>
            </div>
            @endhasrole
            @hasrole(['Bendahara', 'PPTK'])
            <div class="mb-3">
                <a class="btn btn-secondary btn-block" href="{{ (route('PembantuPPTKView.dokumenpendukung.index', ['dpaId' => request()->query('dpaId')])) }}">
                    <i class="fas fa-eye"></i>
                    View Dokumen Pendukung
                </a>
            </div>
            @endhasrole
        </div>
    </div>

    <!-- E-Purchasing Menu -->
    <div class="card mb-3">
        <div class="card-header">
            E-Purchasing Menu
        </div>
        <div class="card-body text-center">
            <!-- First set of buttons -->
            @hasrole('Pembantu PPTK')
            <div class="row justify-content-center mb-3">
                <div class="col-md-6">
                    <a class="btn btn-primary btn-block" href="{{ route('PembantuPPTKView.epurchaseview.create', ['dpaId' => request()->query('dpaId')]) }}">
                        <i class="fas fa-file-alt"></i>
                        Tambah E-Purchasing
                    </a>
                </div>
                <div class="col-md-6">
                <a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.epurchaseview.index', ['dpaId' => request()->query('dpaId')]) }}">
                <i class="fas fa-eye"></i>
                View E-Purchasing
                </a>
                </div>
            </div>
            @endhasrole

            <!-- Second set of buttons -->
            @hasrole(['Bendahara', 'PPTK'])
            <div class="mb-3">
            <a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.epurchaseview.index', ['dpaId' => request()->query('dpaId')]) }}">
                    <i class="fas fa-eye"></i>
                    View E-Purchasing
                </a>
            </div>
            @endhasrole
        </div>
    </div>

        <!-- Dokumen Justifikasi -->
        <div class="card mb-3">
        <div class="card-header">
        Dokumen Justifikasi Menu
        </div>
        <div class="card-body text-center">
            <!-- First set of buttons -->
            @hasrole('Pembantu PPTK')
            <div class="row justify-content-center mb-3">
                <div class="col-md-6">
                    <a class="btn btn-primary btn-block" href="{{ route('PembantuPPTKView.dokumenjustifikasi.create', ['dpaId' => request()->query('dpaId')]) }}">
                        <i class="fas fa-file-alt"></i>
                        Tambah Dokumen Justifikasi
                    </a>
                </div>
                <div class="col-md-6">
                <a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.dokumenjustifikasi.index', ['dpaId' => request()->query('dpaId')]) }}">
                <i class="fas fa-eye"></i>
                View Dokumen Justifikasi
                </a>
                </div>
            </div>
            @endhasrole

            <!-- Second set of buttons -->
            @hasrole(['Bendahara', 'PPTK'])
            <div class="mb-3">
            <a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.dokumenjustifikasi.index', ['dpaId' => request()->query('dpaId')]) }}">
                    <i class="fas fa-eye"></i>
                    View Dokumen Justifikasi
                </a>
            </div>
            @endhasrole
        </div>
    </div>

    <!-- Berita Acara Serah Terima Hasil Pekerjaan (BAST) Menu -->
    <div class="card mb-3">
        <div class="card-header">
            Berita Acara Serah Terima Hasil Pekerjaan (BAST) Menu
        </div>
        <div class="card-body text-center">
            <!-- First set of buttons -->
            @hasrole('Pembantu PPTK')
            <div class="row justify-content-center mb-3">
                <div class="col-md-6">
                    <a class="btn btn-primary btn-block" href="{{ route('PembantuPPTKView.bast.create', ['dpaId' => request()->query('dpaId')]) }}">
                        <i class="fas fa-file-alt"></i>
                        Tambah Dokumen BAST
                    </a>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.bast.index', ['dpaId' => request()->query('dpaId')]) }}">
                        <i class="fas fa-eye"></i>
                        View Dokumen BAST
                    </a>
                </div>
            </div>
            @endhasrole

            <!-- Second set of buttons -->
            @hasrole(['Bendahara', 'PPTK'])
            <div class="mb-3">
            <a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.bast.index', ['dpaId' => request()->query('dpaId')]) }}">
                    <i class="fas fa-eye"></i>
                    View Dokumen Justifikasi
                </a>
            </div>
            @endhasrole
        </div>
    </div>

        <!-- Berita Acara Pembayaran (BAP) Menu -->
        <div class="card mb-3">
        <div class="card-header">
        Berita Acara Pembayaran (BAP) Menu
        </div>
        <div class="card-body text-center">
            <!-- First set of buttons -->
            @hasrole('Pembantu PPTK')
            <div class="row justify-content-center mb-3">
                <div class="col-md-6">
                    <a class="btn btn-primary btn-block" href="{{ route('PembantuPPTKView.bap.create', ['dpaId' => request()->query('dpaId')]) }}">
                        <i class="fas fa-file-alt"></i>
                        Tambah Dokumen BAP
                    </a>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.bap.index', ['dpaId' => request()->query('dpaId')]) }}">
                        <i class="fas fa-eye"></i>
                        View Dokumen BAP
                    </a>
                </div>
            </div>
            @endhasrole
            <!-- Second set of buttons -->
            @hasrole(['Bendahara', 'PPTK'])
            <div class="mb-3">
            <a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.bap.index', ['dpaId' => request()->query('dpaId')]) }}">
                    <i class="fas fa-eye"></i>
                    View Dokumen Justifikasi
                </a>
            </div>
            @endhasrole
        </div>
    </div>

    <!-- Dokumen BAPH Menu -->
    <div class="card mb-3">
        <div class="card-header">
            Dokumen Berita Acara Pemeriksaan Hasil Pekerjaan (BAPH) Menu
        </div>
        <div class="card-body text-center">
            <!-- First set of buttons -->
            @hasrole('Pembantu PPTK')
            <div class="row justify-content-center mb-3">
                <div class="col-md-6">
                <a class="btn btn-primary btn-block" href="{{ route('PembantuPPTKView.baph.create', ['dpaId' => request()->query('dpaId')]) }}">
                        <i class="fas fa-file-alt"></i>
                        Tambah Dokumen BAPH
                    </a>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.baph.index', ['dpaId' => request()->query('dpaId')]) }}">
                        <i class="fas fa-eye"></i>
                        View Dokumen BAPH
                    </a>
                </div>
            </div>
            @endhasrole
            <!-- Second set of buttons -->
            @hasrole(['Bendahara', 'PPTK'])
            <div class="mb-3">
            <a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.baph.index', ['dpaId' => request()->query('dpaId')]) }}">
                    <i class="fas fa-eye"></i>
                    View Dokumen Justifikasi
                </a>
            </div>
            @endhasrole
        </div>
    </div>

    <!-- Pilih Rekanan Menu -->
    <div class="card mb-3">
        <div class="card-header">
            Pilih Rekanan Menu
        </div>
        <div class="card-body text-center">
            <!-- First set of buttons -->
            @hasrole('Pembantu PPTK')
            <div class="row justify-content-center mb-3">
                <div class="col-md-6">
                    <a class="btn btn-primary btn-block" href="{{ route('PembantuPPTKView.pilihrekanan.create', ['dpaId' => request()->query('dpaId')]) }}">
                        <i class="fas fa-file-alt"></i>
                        Tambah Pilihan Rekanan
                    </a>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.pilihrekanan.index', ['dpaId' => request()->query('dpaId')]) }}">
                        <i class="fas fa-eye"></i>
                        View Pilihan Rekanan
                    </a>
                </div>
            </div>
            @endhasrole
            <!-- Second set of buttons -->
            @hasrole(['Bendahara', 'PPTK'])
            <div class="mb-3">
            <a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.pilihrekanan.index', ['dpaId' => request()->query('dpaId')]) }}">
                    <i class="fas fa-eye"></i>
                    View Pilihan Rekanan
                </a>
            </div>
            @endhasrole
        </div>
    </div>
</div>
@endsection
