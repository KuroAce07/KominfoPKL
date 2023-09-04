@extends('layouts.app')

@section('title', 'Dokumen Pembantu PPTK')

@section('content')
<div class="container-fluid">
    <h1>Dokumen Pembantu PPTK</h1>

    <div class="card mb-3">
        <div class="card-header">
            Dokumen Pembantu Menu
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Uraian</th>
                    <th colspan="5">Action</th>
                    <th rowspan="2">Status</th>
                </tr>
                <tr>
                    @hasrole('Pembantu PPTK')
                    <th>Create Dokumen</th>
                    @endhasrole
                    <th>View Dokumen</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Dokumen Kontrak</td>
                        @hasrole('Pembantu PPTK')
                        <td><a class="btn btn-primary btn-block" href="{{ route('PembantuPPTKView.dokumenkontrak.create', ['dpaId' => request()->query('dpaId')]) }}"> Tambah Dokumen Kontrak </a></td>
                        @endhasrole
                        <td><a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.dokumenkontrak.show', ['dpaId' => request()->query('dpaId')]) }}"> View Dokumen Kontrak </a></td>
                        <td colspan="7">
                        @if($dokumenKontrak)
                        <span style="color: green;">Selesai</span>
                        @else
                            <span style="color: red;">Belum</span>
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Dokumen E-Purchasing</td>
                        @hasrole('Pembantu PPTK')
                        <td><a class="btn btn-primary btn-block" href="{{ route('PembantuPPTKView.epurchaseview.create', ['dpaId' => request()->query('dpaId')]) }}"> Tambah E-Purchasing </td>
                        @endhasrole
                        <td><a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.epurchaseview.index', ['dpaId' => request()->query('dpaId')]) }}"> View E-Purchasing</td>
                        <td colspan="7">
                            @if($dokumenEpurchasing)
                            <span style="color: green;">Selesai</span>
                        @else
                            <span style="color: red;">Belum</span>
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Dokumen Pendukung</td>
                        @hasrole('Pembantu PPTK')
                        <td><a class="btn btn-primary btn-block" href="{{ route('PembantuPPTKView.dokumenpendukung.create', ['dpaId' => request()->query('dpaId')]) }}"> Tambah Dokumen Pendukung </td>
                        @endhasrole
                        <td><a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.dokumenpendukung.index', ['dpaId' => request()->query('dpaId')]) }}"> View Dokumen Pendukung </td>
                        <td colspan="7">
                            @if($dokumenPendukung)
                            <span style="color: green;">Selesai</span>
                            @else
                                <span style="color: red;">Belum</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Dokumen Justifikasi</td>
                        @hasrole('Pembantu PPTK')
                        <td><a class="btn btn-primary btn-block" href="{{ route('PembantuPPTKView.dokumenjustifikasi.create', ['dpaId' => request()->query('dpaId')]) }}"> Tambah Dokumen Justifikasi </td>
                        @endhasrole
                        <td><a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.dokumenjustifikasi.index', ['dpaId' => request()->query('dpaId')]) }}"> View Dokumen Justifikasi </td>
                        <td colspan="7">
                            @if($dokumenjustifikasi)
                            <span style="color: green;">Selesai</span>
                            @else
                                <span style="color: red;">Belum</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Berita Acara Serah Terima Hasil Pekerjaan (BAST) </td>
                        @hasrole('Pembantu PPTK')
                        <td><a class="btn btn-primary btn-block" href="{{ route('PembantuPPTKView.bast.create', ['dpaId' => request()->query('dpaId')]) }}"> Tambah Dokumen BAST</td>
                        @endhasrole
                        <td><a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.bast.index', ['dpaId' => request()->query('dpaId')]) }}"> View Dokumen BAST </td>
                        <td colspan="7">
                            @if($bast)
                            <span style="color: green;">Selesai</span>
                            @else
                                <span style="color: red;">Belum</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Berita Acara Pembayaran (BAP)</td>
                        @hasrole('Pembantu PPTK')
                        <td><a class="btn btn-primary btn-block" href="{{ route('PembantuPPTKView.bap.create', ['dpaId' => request()->query('dpaId')]) }}"> Tambah Dokumen BAP </a></td>
                        @endhasrole
                        <td><a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.bap.index', ['dpaId' => request()->query('dpaId')]) }}"> View Dokumen BAP </a></td>
                        <td colspan="7">
                            @if($bap)
                            <span style="color: green;">Selesai</span>
                            @else
                                <span style="color: red;">Belum</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Berita Acara Pemeriksaan Hasil Pekerjaan (BAPH)</td>
                        @hasrole('Pembantu PPTK')
                        <td><a class="btn btn-primary btn-block" href="{{ route('PembantuPPTKView.baph.create', ['dpaId' => request()->query('dpaId')]) }}"> Tambah Dokumen BAPH </td>
                        @endhasrole
                        <td><a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.baph.index', ['dpaId' => request()->query('dpaId')]) }}"> View Dokumen BAPH </td>
                        <td colspan="7">
                            @if($baph)
                            <span style="color: green;">Selesai</span>
                            @else
                                <span style="color: red;">Belum</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Pilih Rekanan</td>
                        @hasrole('Pembantu PPTK')
                        <td><a class="btn btn-primary btn-block" href="{{ route('PembantuPPTKView.pilihrekanan.create', ['dpaId' => request()->query('dpaId')]) }}"> Pilih Rekanan </td>
                        @endhasrole
                        <td><a class="btn btn-secondary btn-block" href="{{ route('PembantuPPTKView.pilihrekanan.index', ['dpaId' => request()->query('dpaId')]) }}"> View Rekanan </td>
                        <td colspan="7">
                            @if($pilihRekanan)
                            <span style="color: green;">Selesai</span>
                            @else
                                <span style="color: red;">Belum</span>
                            @endif
                        </td>
                    </tr>
                    <!-- Repeat rows for other submenus -->
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection




