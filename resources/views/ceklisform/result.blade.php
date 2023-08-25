@extends('layouts.app')

@section('content')
    <div class="container">
        
        <h2>Hasil Ceklis Form</h2>
        @foreach ($ceklisForms as $ceklisForm)
        <table class="table">
            <thead>
                <tr>
                    <th>Nama berkas</th>
                        <th>Check</th>
                    <!-- Add headers for other fields -->
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Keterangan:</td>
                    <td>{{ $ceklisForm->nama }}</td>
                </tr>
                <tr>
                    <td>Kwitansi</td>
                    <td>{{ $ceklisForm->kwitansi ? 'Checked' : 'Unchecked' }}</td>
                </tr>
                <tr>
                    <td>Nota Bukti Invoice</td>
                    <td>{{ $ceklisForm->nota_bukti_invoice ? 'Checked' : 'Unchecked' }}</td>
                </tr>
                <tr>
                    <td>Surat Pemesanan</td>
                    <td>{{ $ceklisForm->surat_pemesanan ? 'Checked' : 'Unchecked' }}</td>
                </tr>
                <tr>
                    <td>Dokumen Kontrak</td>
                    <td>{{ $ceklisForm->dok_kontrak ? 'Checked' : 'Unchecked' }}</td>
                </tr>
                <tr>
                    <td>Surat Perjanjian</td>
                    <td>{{ $ceklisForm->surat_perjanjiann ? 'Checked' : 'Unchecked' }}</td>
                </tr>
                <tr>
                    <td>Dokumen E-Purchasing</td>
                    <td>{{ $ceklisForm->dok_epurchasing ? 'Checked' : 'Unchecked' }}</td>
                </tr>
                <tr>
                    <td>Risalah/Ringkasan Kontrak</td>
                    <td>{{ $ceklisForm->ringkasan_kontrak ? 'Checked' : 'Unchecked' }}</td>
                </tr>
                <tr>
                    <td>Dokumen Pendukung</td>
                    <td>{{ $ceklisForm->dok_pendukung ? 'Checked' : 'Unchecked' }}</td>
                </tr>
                <tr>
                    <td>Tabel Barang jika Komposisi TKDN < 40%</td>
                    <td>{{ $ceklisForm->tkdn ? 'Checked' : 'Unchecked' }}</td>
                </tr>
                <tr>
                    <td>Berita Acara Serah Terima Hasil Pekerjaan</td>
                    <td>{{ $ceklisForm->berita_serah_terima ? 'Checked' : 'Unchecked' }}</td>
                </tr>
                <tr>
                    <td>Berita Acara Pembayaran</td>
                    <td>{{ $ceklisForm->berita_pembayaran ? 'Checked' : 'Unchecked' }}</td>
                </tr>
                <tr>
                    <td>Berita_pemeriksaan</td>
                    <td>{{ $ceklisForm->berita_pemeriksaan ? 'Checked' : 'Unchecked' }}</td>
                </tr>
                    
                    
                    
                    
                
    
                    
                    
                    
                    <!-- Add cells for other fields -->
               
                         
                        
                       
                      
                        
                        
                        
                        
                       
                       
                        
                        
                        
             
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
