<?php
// app/Imports/ArsipLamaImport.php

namespace App\Imports;

use App\Models\ArsipLama;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ArsipLamaImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            // Check if the row has all required values (assuming it starts from index 0)
            if (count($row) < 17) {
                continue;
            }

            // Convert date string to a valid format
            $tanggal_spm = is_numeric($row[1]) ? Date::excelToDateTimeObject($row[1])->format('Y-m-d') : null;
            $tanggal_sp2d = is_numeric($row[15]) ? Date::excelToDateTimeObject($row[15])->format('Y-m-d') : null;

            // Convert nilai_spm to a valid numeric format
            $nilai_spm = is_numeric($row[2]) ? (float) $row[2] : null;

            // Convert pph_21, pph_22, pph_23, ppn to a valid numeric format
            $pph_21 = is_numeric($row[9]) ? (float) $row[9] : null;
            $pph_22 = is_numeric($row[10]) ? (float) $row[10] : null;
            $pph_23 = is_numeric($row[11]) ? (float) $row[11] : null;
            $ppn = is_numeric($row[12]) ? (float) $row[12] : null;

            // Convert ppnd to a valid numeric format
            $ppnd = is_numeric($row[13]) ? (float) $row[13] : null;

            ArsipLama::create([
                'no_spm' => $row[0] ?? null,
                'tanggal_spm' => $tanggal_spm,
                'nilai_spm' => $nilai_spm,
                'terbilang' => $row[3] ?? null,
                'sumber_dana' => $row[4] ?? null,
                'uraian_belanja' => $row[5] ?? null,
                'sub_kegiatan' => $row[6] ?? null,
                'kegiatan' => $row[7] ?? null,
                'nama' => $row[8] ?? null,
                'pph_21' => $pph_21,
                'pph_22' => $pph_22,
                'pph_23' => $pph_23,
                'ppn' => $ppn,
                'ppnd' => $ppnd,
                'lain_lain' => $row[14] ?? null,
                'tanggal_sp2d' => $tanggal_sp2d,
                'no_sp2d' => $row[16] ?? null,
            ]);
        }
    }
}
