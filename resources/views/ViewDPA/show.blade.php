@extends('layouts.app')

@section('title', 'Sub DPA Details')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sub DPA</h1>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')
    
    <!-- Display Sub Kegiatan -->
    @foreach ($dpa->subDPA as $index => $sub_dpa)
        @php
            $subkegiatan = $sub_dpa->sub_kegiatan;
            $kodeRekeningLines = explode("\n", $sub_dpa->kode_rekening);
            $uraianLines = explode("\n", $sub_dpa->uraian);
            $koefisienLines = explode("\n", $sub_dpa->koefisien);
            $satuanLines = explode("\n", $sub_dpa->satuan);
            $hargaLines = explode("\n", $sub_dpa->harga);
            $jumlahLines = explode("\n", $sub_dpa->jumlah);
            $sumberDana = $sub_dpa->sumber_dana;
            $jenisbarang = $sub_dpa->jenis_barang;
            $JASK = $sub_dpa->jumlah_anggaran_sub_kegiatan;
            $maxRows = max(count($kodeRekeningLines), count($uraianLines), count($koefisienLines), count($satuanLines), count($hargaLines), count($jumlahLines));
        @endphp
        
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Sub Kegiatan : {{ $subkegiatan }}</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Kode Rekening</th>
                                <th>Uraian</th>
                                <th>Koefisien</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th>PPN</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop through rows for the current subDPA -->
                            @for ($rowIndex = 0; $rowIndex < $maxRows; $rowIndex++)
                                <tr>
                                    <td>
                                    @if ($rowIndex === 5)
                                    @elseif ($rowIndex === 6)
                                    @elseif ($rowIndex === 7)
                                    @php
                                    $kr = 5
                                    @endphp
                                    {{ $kodeRekeningLines[$kr] ?? '' }}
                                    @elseif ($rowIndex === 8)
                                    @php
                                    $kr = 6
                                    @endphp
                                    {{ $kodeRekeningLines[$kr] ?? '' }}
                                    @elseif ($rowIndex === 9)
                                    @php
                                    $kr = 7
                                    @endphp
                                    {{ $kodeRekeningLines[$kr] ?? '' }}
                                    @else
                                    {{ $kodeRekeningLines[$rowIndex] ?? '' }}</td>
                                    @endif
                                    
                                    <td>
                                        @if ($rowIndex === (count($jumlahLines) - 1) && $rowIndex < 8)
                                        {{ $sumberDana }}
                                        @elseif ($rowIndex === 5)
                                        {{ substr($sumberDana, 0, strpos($sumberDana, '[#]')) }}
                                        @elseif ($rowIndex === 6)
                                        @php
    $startPos = strpos($jenisbarang, 'Fotocopy F4/A4 70 Gram');
    $endPos = strpos($jenisbarang, 'FotoCopySpesifikasi ', $startPos);
    if ($startPos !== false && $endPos !== false) {
        $extractedText = substr($jenisbarang, $startPos, $endPos - $startPos);
    } else {
        $extractedText = $jenisbarang;
    }
@endphp

{{ $extractedText }}


                                        @elseif ($rowIndex === 10 && strpos($sumberDana, '[#]') !== false)
                                        {{ substr($sumberDana, strpos($sumberDana, '[#]') + 4) }}
                                        @elseif ($rowIndex === 11)
                                        Spesifikasi: Biaya Transportasi Darat Dari Kota Batu Ke Kota Surabaya Dalam Provinsi Yang Sama One Way
                                        @elseif ($rowIndex === 12)
                                        Spesifikasi: Uang Harian Perjalanan Dinas Dalam Negeri Luar Kota - Jawa Timur
                                        @elseif ($rowIndex === 7)
                                    @php
                                    $kr = 5
                                    @endphp
                                    {!! $uraianLines[$kr] ?? '' !!}
                                    @elseif ($rowIndex === 8)
                                    @php
                                    $kr = 6
                                    @endphp
                                    {!! $uraianLines[$kr] ?? '' !!}
                                    @elseif ($rowIndex === 9)
                                    @php
                                    $kr = 7
                                    @endphp
                                    {!! $uraianLines[$kr] ?? '' !!}
                                        @else
                                        {!! $uraianLines[$rowIndex] ?? '' !!}
                                        @endif
                                    </td>
                                    <td>
                                    @if ($rowIndex === 6)
                                    3125 Lembar
                                    @elseif($rowIndex === 11)
                                    4 Orang / Kali
                                    @elseif($rowIndex === 12)
                                    4 Orang / Hari
                                    @endif
                                    </td>
                                    <td>
                                    @if ($rowIndex === 6)
                                    Lembar
                                    @elseif($rowIndex === 11)
                                    Orang / Kali
                                    @elseif($rowIndex === 12)
                                    Orang / Hari
                                    @endif
                                    </td>
                                    <td> 
                                    @if ($rowIndex === 6)
                                    400
                                    @elseif($rowIndex === 11)
                                    242.000
                                    @elseif($rowIndex === 12)
                                    410.000
                                    @endif
                                    </td>
                                    <td></td>
                                    <td>{{ $jumlahLines[$rowIndex] ?? '' }}</td>
                                </tr>
                            @endfor

                            <!-- Add a new row for jenis_barang -->
                            @if($maxRows>8)
                            @else
                            <tr>
                                <td></td>
                                <td>{!! preg_replace('/\s*Spesifikasi\s*:\s*/i', '<br>Spesifikasi: ', $jenisbarang) !!}</td>
                                <td>{{ $koefisienLines[count($koefisienLines) - 1] ?? '' }}</td>
                                <td>{{ $satuanLines[count($satuanLines) - 1] ?? '' }}</td>
                                <td>{{ $hargaLines[count($hargaLines) - 1] ?? '' }}</td>
                                <td>0</td>
                                <td>{{ $jumlahLines[count($jumlahLines) - 1] ?? '' }}</td>
                            </tr>
                            @endif
                        <tr>
                        <td></td>
                        <td>Jumlah Anggaran Sub Kegiatan</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{ $JASK }}</td>
                    </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
