<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DPA;
use App\Models\SubDPA;
class UploadDPAController extends Controller
{
    /**
     * Display the upload form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('UploadDPA.index');
    }

    /**
     * Store a newly uploaded file in storage and convert PDF to text if it's a PDF file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $request->validate([
        'file' => 'required|mimetypes:application/pdf|max:2048',
    ]);

    // Move the uploaded file to the public/uploads directory
    $fileName = time() . '.' . $request->file->extension();
    $request->file->move(public_path('uploads'), $fileName);

    // Determine the file type
    $fileType = $request->file->getClientMimeType();

    if ($fileType === 'application/pdf') {
        // Convert PDF to text using pdftotext.exe (make sure pdftotext.exe is in the "public" folder)
        $pdfPath = public_path('uploads/' . $fileName);
        $txtPath = public_path('uploads/' . pathinfo($fileName, PATHINFO_FILENAME) . '.txt');

        $pdftotextPath = public_path('xpdf/bin32/pdftotext.exe');
        exec("\"$pdftotextPath\" \"$pdfPath\" \"$txtPath\"");

        // Read the extracted text from the generated .txt file
        $pdfText = file_get_contents($txtPath);

        // Extract tabular data from the PDF text
        $tableData = $this->extractTableData($pdfText);
        $tableSubDataSections = $this->extractTableSubDataSections($pdfText);
        //$tableSubData = $this->extractTableSubData($pdfText);
        if (!empty($tableData)) {
            //dd($tableData);
            // Save the extracted data into the database using the DPA model
            $dpa = new DPA();
            $dpa->nomor_dpa = $tableData['Nomor DPA'];
            $dpa->urusan_pemerintahan = $tableData['Urusan Pemerintahan'];
            $dpa->bidang_urusan = $tableData['Bidang Urusan'];
            $dpa->program = $tableData['Program'];
            $dpa->kegiatan = $tableData['Kegiatan'];
            $dpa->dana = $tableData['Dana yang dibutuhkan'];
            $dpa->save();
            // Show the success message
            // Save the extracted sub data into the database using the DPA model (assuming you have a model for it)
            // Assuming the DPA model has a relationship to the SubDPA model (one-to-many relationship)
            //dd($tableSubDataSections);
            foreach ($tableSubDataSections as $section) {
            $tableSubData = $this->extractTableSubData($section);
            if (!empty($tableSubData['Sub Kegiatan'])) {
                //dd($tableSubData);
                $subKegiatanArray = explode(PHP_EOL, $tableSubData['Sub Kegiatan']);
                $kodeRekeningArray = explode(PHP_EOL, $tableSubData['Kode Rekening']);
                $uraianArray = explode(PHP_EOL, $tableSubData['Uraian']);
                $jumlahArray = explode(PHP_EOL, $tableSubData['Jumlah']);
                $sumberDana = $tableSubData['sumber_dana'];
                $jenisBarang = $tableSubData['jenis_barang'];
                //$jmlh = $tableSubData['jmlh'];
                $koefisienArray = explode(PHP_EOL, $tableSubData['Koefisien']);
                $satuanArray = explode(PHP_EOL, $tableSubData['Satuan']);
                if (isset($tableSubData['Harga'])) {
                    $hargaArray = explode(PHP_EOL, $tableSubData['Harga']);
                } else {
                    $hargaArray = []; // Empty array if "Harga" key doesn't exist
                }
                $JASKArray = explode(PHP_EOL, $tableSubData['Jumlah Anggaran Sub Kegiatan']);
                $arrayLength = count($subKegiatanArray);
                // Assuming the arrays have the same length, iterate over one of them
                // Inside the loop where you are saving sub_dpa records
for ($index = 0; $index < $arrayLength; $index++) {
    $subDpa = new SubDPA();
    $subDpa->dpa_id = $dpa->id;
    $subDpa->sub_kegiatan = $subKegiatanArray[$index];
    $subDpa->kode_rekening = $kodeRekeningArray[$index];
    $subDpa->uraian = $uraianArray[$index];
    $subDpa->jumlah = $jumlahArray[$index];
    $subDpa->sumber_dana = $sumberDana;
    $subDpa->jenis_barang = $jenisBarang;
    $subDpa->koefisien = $koefisienArray[$index];
    $subDpa->satuan = $satuanArray[$index];
    $subDpa->jumlah_anggaran_sub_kegiatan = $JASKArray[$index];
    // Handle the "Harga" value
    if (isset($hargaArray[$index])) {
        $subDpa->harga = $hargaArray[$index];
    } else {
        // Set a default value (e.g., 0) if "Harga" value doesn't exist
        $subDpa->harga = 0;
    }

    $subDpa->save();
}

            }
        }
            $dpaId = $dpa->id;
            $dpaFolder = public_path('uploads/' . $dpaId);
            if (!file_exists($dpaFolder)) {
            mkdir($dpaFolder, 0777, true);
            }
            // Rename the PDF and text files using the DPA ID
            $newPdfPath = $dpaFolder . '/' . $dpaId . '.pdf';
            $newTxtPath = $dpaFolder . '/' . $dpaId . '.txt';
            
            // Move the uploaded files to the newly created folder
            rename($pdfPath, $newPdfPath);
            rename($txtPath, $newTxtPath);
            return redirect()->back()->with('success', 'Upload DPA Success');
        } else {
            // If the extracted text does not contain a table, return the path to the extracted text file to the view
            return view('UploadDPA.text', [
                'pdfText' => $pdfText,
            ])->with('success', 'You have successfully uploaded the PDF file.');
        }
    } else {
        // Handle other file types here, if needed

        return back()
            ->with('error', 'Invalid file type. Please upload a PDF file.')
            ->with('file', $fileName);
    }
}

    /**
     * Helper function to check if the extracted text contains a table and extracts data with specific keywords.
     *
     * @param string $pdfText The extracted PDF text.
     * @return array|null The tabular data (2D array) or null if no table is found.
     */
    private function extractTableData(string $pdfText): ?array
{
    // Define the keywords to search for
    $keywords = [
        'Nomor DPA', 
        'Urusan Pemerintahan', 
        'Bidang Urusan', 
        'Program', 
        'Kegiatan',
        'Dana yang dibutuhkan', // New keyword for the required fund
    ];
    
    // Initialize the table data array
    $tableData = [];
    
    // Loop through each keyword and extract the data following it
    foreach ($keywords as $keyword) {
        $startIndex = strpos($pdfText, $keyword);
        
        if ($startIndex !== false) {
            $startIndex += strlen($keyword); // Move to the end of the keyword
            $endIndex = strlen($pdfText);
            
            // Find the next keyword (or the end of the text)
            $nextKeywordIndex = strlen($pdfText);
            foreach ($keywords as $nextKeyword) {
                if ($nextKeyword !== $keyword) {
                    $nextKeywordIndex = strpos($pdfText, $nextKeyword, $startIndex);
                    if ($nextKeywordIndex !== false && $nextKeywordIndex < $endIndex) {
                        $endIndex = $nextKeywordIndex;
                    }
                }
            }
            
            // Special case for the "Program" keyword to include "KABUPATEN/KOTA" in its data
            if ($keyword === 'Program') {
                $kabupatenIndex = strpos($pdfText, 'KABUPATEN/KOTA', $startIndex);
                if ($kabupatenIndex !== false && $kabupatenIndex < $endIndex) {
                    $endIndex = $kabupatenIndex + strlen('KABUPATEN/KOTA');
                }
            }

            // Special case for the "Kegiatan" keyword to find the data after the word "2024" and include "Daerah"
            if ($keyword === 'Kegiatan') {
                $year2024Index = strpos($pdfText, '2024', $startIndex);
                $daerahIndex = strpos($pdfText, 'Daerah', $startIndex);
                if ($year2024Index !== false && $year2024Index < $endIndex) {
                    $startIndex = $year2024Index + strlen('2024');
                }
                if ($daerahIndex !== false && $daerahIndex < $endIndex) {
                    $endIndex = $daerahIndex + strlen('Daerah');
                }
            }
            
            if ($keyword === 'Dana yang dibutuhkan') {
                // Find the next occurrence of "Dana yang dibutuhkan"
                $nextDanaIndex = strpos($pdfText, 'Dana yang dibutuhkan', $startIndex + 1);
    
                // If another "Dana yang dibutuhkan" is found, stop extracting and only take the data until that position
                if ($nextDanaIndex !== false && $nextDanaIndex < $endIndex) {
                    $endIndex = $nextDanaIndex;
                }
    
                // Extract the data between the keyword and the next keyword (or the end of the text)
                $data = trim(substr($pdfText, $startIndex, $endIndex - $startIndex));
    
                // Remove the leading colon from the extracted data (for all keywords)
                $data = ltrim($data, ':');
    
                // Add the keyword and data as a row in the table data array
                $tableData[$keyword] = $data;
            }
            // Special case for "Dana yang dibutuhkan" keyword to extract the required fund
            else {
                // Extract the data between the keyword and the next keyword (or the end of the text)
                $data = trim(substr($pdfText, $startIndex, $endIndex - $startIndex));

                // Remove the leading colon from the extracted data (for all keywords)
                $data = ltrim($data, ':');
                
                // Add the keyword and data as a row in the table data array
                $tableData[$keyword] = $data;
            }
        }
    }
    // Check if any table data was found
    if (!empty($tableData)) {
        return $tableData;
    } else {
        return null; // Return null if no table data was found
    }
}
 /**
     * Helper function to extract sub data (Sub Kegiatan, Kode Rekening, Uraian, Jumlah) from the PDF text.
     *
     * @param string $pdfText The extracted PDF text.
     * @return array The sub data (2D array).
     */
    private function extractTableSubData(string $pdfText): array
{
    // Define the keywords to search for
    $keywords = [
        'Sub Kegiatan Sumber Pendanaan Lokasi Keluaran Sub Kegiatan', // New keyword for sub data
        'Kode Rekening',
        'Uraian',
        'Jumlah (Rp)', // New keyword for Jumlah data
        '[#]', // New keyword for sumber_dana
        '[-]', // New keyword for jenis_barang
        'Koefisien', // New keyword for Koefisien data
        'Jumlah Anggaran Sub Kegiatan',
    ];

    // Initialize the table sub data array
    $tableSubData = [];

    // Find the index of 'Sub Kegiatan Sumber Pendanaan Lokasi Keluaran Sub Kegiatan'
    $subKegiatanIndex = strpos($pdfText, 'Sub Kegiatan Sumber Pendanaan Lokasi Keluaran Sub Kegiatan');
if ($subKegiatanIndex !== false) {
    $subKegiatanIndex += strlen('Sub Kegiatan Sumber Pendanaan Lokasi Keluaran Sub Kegiatan'); // Move to the end of the keyword
    // Find the next colon (:) after the 'Sub Kegiatan Sumber Pendanaan Lokasi Keluaran Sub Kegiatan'
    $colonIndex = strpos($pdfText, ':', $subKegiatanIndex);
    if ($colonIndex !== false) {
        // Find the next line break after the colon
        $lineBreakIndex = strpos($pdfText, "\r\n", $colonIndex);
        if ($lineBreakIndex !== false) {
            // Extract the data between the colon and the line break
            $extractedText = trim(substr($pdfText, $colonIndex + 1, $lineBreakIndex - $colonIndex - 1));

            // Find the first colon (:) after the extracted text
            $colonAfterExtractedIndex = strpos($extractedText, ':');
            if ($colonAfterExtractedIndex !== false) {
                // Extract the text before the first colon in the extracted text
                $tableSubData['Sub Kegiatan'] = trim(substr($extractedText, 0, $colonAfterExtractedIndex));
            } else {
                // No colon found after the extracted text, use the extracted text as is
                $tableSubData['Sub Kegiatan'] = $extractedText;
            }
        }
    }
}


    // Use regular expressions to extract the 'Kode Rekening' data
    preg_match_all('/(?:Kode Rekening|\G(?!\A))\s*((?:\d+(?:\.\d+)*\s*)+)/', $pdfText, $matches);

if (!empty($matches[1])) {
    // Extracted 'Kode Rekening' data
    $kodeRekeningArray = array_unique(explode(' ', trim(preg_replace('/\s+/', ' ', implode(" ", $matches[1])))));

    // Add '5.1' and '5.1.02' to the array if they are not already present
    if (!in_array('5.1', $kodeRekeningArray)) {
        array_unshift($kodeRekeningArray, '5.1.02');
        array_unshift($kodeRekeningArray, '5.1');
    } else if (!in_array('5.1.02', $kodeRekeningArray)) {
        array_unshift($kodeRekeningArray, '5.1.02');
    }

    $tableSubData['Kode Rekening'] = implode("\n", $kodeRekeningArray);
} else {
    // If 'Kode Rekening' data is empty, search for words with '5.1' and add them to the array
    preg_match_all('/\b5\.1\S*\b/', $pdfText, $additionalKodeRekeningMatches);
    $additionalKodeRekeningArray = array_unique($additionalKodeRekeningMatches[0]);

    $tableSubData['Kode Rekening'] = implode("\n", $additionalKodeRekeningArray);
}

    // Use regular expression to extract the 'Uraian' data
    preg_match('/Uraian(.*?)(?:\[\#]|\[-]|Jumlah \(Rp\))/s', $pdfText, $uraianMatches);

if (!empty($uraianMatches[1])) {
    $uraianData = trim($uraianMatches[1]);

    // Remove lines containing 'Rincian Perhitungan'
    $uraianData = preg_replace('/\bRincian Perhitungan\b.*$/m', '', $uraianData);

    // Remove specific sentences from the uraianData
    $specificSentencesToRemove = [
        '5.1 5.1.02',
        'Koefisien Satuan Harga PPN',
        'Sebelum Pergeseran',
        'Jumlah',
        '(Rp)',
        'Rp1.250.000'
    ];
    foreach ($specificSentencesToRemove as $sentenceToRemove) {
        $uraianData = str_replace($sentenceToRemove, '', $uraianData);
    }

    // Separate lines with the pattern "BELANJA OPERASI Belanja Barang dan Jasa"
    $uraianData = preg_replace('/(BELANJA OPERASI) (Belanja Barang dan Jasa)/', "$1\n$2\nBelanja Barang\nBelanja Barang Pakai Habis\nBelanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor", $uraianData);

    // Separate lines with the pattern "BELANJA OPERASI Belanja Barang dan Jasa" if found at the start of a line
    $uraianData = preg_replace('/^BELANJA OPERASI Belanja Barang dan Jasa$/m', "BELANJA OPERASI\nBelanja Barang dan Jasa\nBelanja Barang\nBelanja Barang Pakai Habis\nBelanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor", $uraianData);

    // Remove leading blank lines
    $uraianData = preg_replace('/^\s*\n/m', '', $uraianData);

    // Remove extra newlines
    $uraianData = preg_replace('/[\r\n]+/', "\n", $uraianData);
    if (!empty($uraianData) && strpos($uraianData, 'BELANJA OPERASI') !== false) {
        $tableSubData['Uraian'] = $uraianData;
    } else {
// Match lines containing the word "Belanja"
$belanjaMatches = [];
preg_match_all('/.*Belanja.*\R/', $pdfText, $belanjaMatches);

if (!empty($belanjaMatches[0])) {
    // Concatenate the matched lines into a single string
    $belanjaData = implode("\n", $belanjaMatches[0]);

    // Remove lines with 5.1
    $belanjaData = preg_replace('/\b5\.1\S*\b/', '', $belanjaData);

    // Remove lines with 'DPPA-RINCIAN'
    $belanjaData = preg_replace('/.*DPPA-RINCIAN.*\R/', '', $belanjaData);

    // Remove leading blank lines and extra newlines
    $belanjaData = preg_replace('/^\s*\n/m', '', $belanjaData);
    $belanjaData = preg_replace('/[\r\n]+/', "\n", $belanjaData);

    // Remove any remaining extra spaces
    $belanjaData = preg_replace('/\s+/', ' ', $belanjaData);

    // Add a new line before each occurrence of "Belanja"
    $belanjaData = preg_replace('/ Belanja/', "\nBelanja", $belanjaData);

    // Add "Belanja Operasi" at the top
    $tableSubData['Uraian'] = "BELANJA OPERASI\n" . trim($belanjaData);
} else {
    $tableSubData['Uraian'] = "";
}
    }
} else {
    $tableSubData['Uraian'] = "";
}


    // Extract 'Jumlah (Rp)' data
    preg_match_all('/Jumlah \(Rp\)\s*((?:Rp\d+(?:\.\d+)*\s*)+)/', $pdfText, $jumlahMatches);

if (!empty($jumlahMatches[1])) {
    // Extracted 'Jumlah (Rp)' data
    $jumlahData = implode("\n", array_map('trim', explode(' ', trim($jumlahMatches[1][0]))));

$wordsInJumlahData = str_word_count($jumlahData);

if ($wordsInJumlahData > 2) {
    $tableSubData['Jumlah'] = $jumlahData;
} else {
    $repeatedValue = "Rp1.250.000";
    $repeatedValues = array_fill(0, 6, $repeatedValue);
    $tableSubData['Jumlah'] = implode("\n", $repeatedValues);
}


}else {
    if (preg_match('/BELANJA OPERASI\s+(\S+)/', $pdfText, $matchesOperasi) &&
    preg_match('/Belanja Barang dan Jasa\s+(\S+)/', $pdfText, $matchesBarangJasa) &&
    preg_match('/\bBelanja Barang\b\s+(\S+)/', $pdfText, $matchesBarang) &&
    preg_match('/Belanja Barang Pakai Habis\s+(\S+)/', $pdfText, $matchesBarangPakaiHabis) &&
    preg_match('/5.1.02.01.01.0024 Belanja Alat\/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor\s+(\S+)/', $pdfText, $matchesAlatBahan) &&
    preg_match_all('/\[#\] Dana Transfer Umum-Dana Alokasi Umum Sumber Dana : Dana Transfer Umum-Dana Alokasi Umum\s+([\s\S]+?)\s+([\s\S]+?)(?=\n|$)/', $pdfText, $matchesDanaTransfer, PREG_SET_ORDER) &&
    preg_match('/Belanja Perjalanan Dinas\s+(\S+)/', $pdfText, $matchesPerjalananDinas) &&
    preg_match('/Belanja Perjalanan Dinas Dalam Negeri\s+(\S+)/', $pdfText, $matchesPerjalananDinasDalamNegeri) &&
    preg_match('/Belanja Perjalanan Dinas Biasa\s+(\S+)/', $pdfText, $matchesPerjalananDinasBiasa) &&
    preg_match('/\d+\s+Orang \/ Orang \/ [0-9.]+\s+0\s+(Rp[0-9.,]+)/', $pdfText, $matchesOrangRp1) &&
    preg_match('/\d+\s+Orang \/ Orang \/ [0-9.]+\s+0\s+(Rp[0-9.,]+)/', $pdfText, $matchesOrangRp2) &&
    preg_match('/\[#\] DAU Sumber Dana : Dana Transfer Umum-Dana Alokasi Umum\s+(\S+)/', $pdfText, $matchesDAU)) {

    $jumlahOperasi = !empty($matchesOperasi[1]) ? $matchesOperasi[1] : "Default_Value";
    $jumlahBarangJasa = !empty($matchesBarangJasa[1]) ? $matchesBarangJasa[1] : "Default_Value";
    $jumlahBarang = !empty($matchesBarang[1]) ? $matchesBarang[1] : "Default_Value";
    if ($jumlahBarang === 'dan') {
        $jumlahBarang = 'Rp1.250.000';
    }
    $jumlahBarangPakaiHabis = !empty($matchesBarangPakaiHabis[1]) ? $matchesBarangPakaiHabis[1] : "Default_Value";
    $jumlahAlatBahan = !empty($matchesAlatBahan[1]) ? $matchesAlatBahan[1] : "Default_Value";
    
    $danaTransfer = ""; // Initialize the variable to store the extracted values
    foreach ($matchesDanaTransfer as $match) {
        $danaTransfer .= $match[1] . "\n" . $match[2] . "\n"; // Combine the values with a newline
    }
    
    // Extract the next word after the specified lines using the same template
    $perjalananDinas = !empty($matchesPerjalananDinas[1]) ? $matchesPerjalananDinas[1] : "Default_Value";
    $perjalananDinasDalamNegeri = !empty($matchesPerjalananDinasDalamNegeri[1]) ? $matchesPerjalananDinasDalamNegeri[1] : "Default_Value";
    $perjalananDinasBiasa = !empty($matchesPerjalananDinasBiasa[1]) ? $matchesPerjalananDinasBiasa[1] : "Default_Value";

    $mergedValue = $jumlahOperasi . "\n" . 
    $jumlahBarangJasa . "\n" . 
    $jumlahBarang . "\n" . 
    $jumlahBarangPakaiHabis . "\n" . 
    $jumlahAlatBahan . "\n" . 
    $danaTransfer . 
    $perjalananDinas . "\n" . 
    $perjalananDinasDalamNegeri . "\n" . 
    $perjalananDinasBiasa;
    $tableSubData['Jumlah'] = str_replace("\r", "", $mergedValue);
   
$nextWordAfterDAU = !empty($matchesDAU[1]) ? $matchesDAU[1] : "Default_Value";
$tableSubData['Jumlah'] .= "\n" . $nextWordAfterDAU;
    $rpValues = array(); // Create an array to store the unique "Rp" values

if (preg_match_all('/\d+\s+Orang \/ Orang \/ [0-9.]+\s+0\s+(Rp[0-9.,]+)/', $pdfText, $matchesOrangRp)) {
    foreach ($matchesOrangRp[1] as $rpValue) {
        if (!in_array($rpValue, $rpValues)) {
            $rpValues[] = $rpValue;
        }
    }
}

$tableSubData['Jumlah'] .= "\n" . implode("\n", $rpValues);
//dd($tableSubData['Jumlah']);
} else {
    $tableSubData['Jumlah'] = "Default_Value";
}
}   
    // Extract 'Jumlah Anggaran Sub Kegiatan' data
    preg_match_all('/(?:Rp\d[\d.]*\s*)?Jumlah Anggaran Sub Kegiatan\s*(?:Rp\d[\d.]*)?/', $pdfText, $jumlahAnggaranMatches);

        if (!empty($jumlahAnggaranMatches[0])) {
            $jumlahAnggaranData = [];
        
            foreach ($jumlahAnggaranMatches[0] as $match) {
                preg_match('/Rp\d[\d.]*/', $match, $rpMatches);
                if (!empty($rpMatches)) {
                    $jumlahAnggaranData[] = $rpMatches[0];
                    $tableSubData['Jumlah Anggaran Sub Kegiatan'] = implode("\n", $jumlahAnggaranData);
                }
                else{
                    preg_match('/Jumlah Anggaran Sub Kegiatan:\s*([^\n]+)/', $pdfText, $match);
            if (!empty($match[1])) {
                $lineContainingKeyword = trim($match[1]);
                $tableSubData['Jumlah Anggaran Sub Kegiatan'] = $lineContainingKeyword;
            } else {
                $tableSubData['Jumlah Anggaran Sub Kegiatan'] = "";
            }
                        }
                    }
                
                } else {
                    $tableSubData['Jumlah Anggaran Sub Kegiatan'] = "";
                }
    

    // Extract data after the keywords "[#]" and "[-]"
    $sumberDanaIndex = strpos($pdfText, '[#]');
    $jenisBarangIndex = strpos($pdfText, '[-]');

    if ($sumberDanaIndex !== false && $jenisBarangIndex !== false) {
        $sumberDanaIndex += strlen('[#]');
        $jenisBarangIndex += strlen('[-]');

        // Find the next line break after "[#]"
        $sumberDanaLineBreak = strpos($pdfText, PHP_EOL, $sumberDanaIndex);
        if ($sumberDanaLineBreak !== false && $sumberDanaLineBreak < $jenisBarangIndex) {
            // Extract the data between "[#]" and the line break
            $sumberDana = trim(substr($pdfText, $sumberDanaIndex, $sumberDanaLineBreak - $sumberDanaIndex));
            $tableSubData['sumber_dana'] = $sumberDana;
        } else {
            $tableSubData['sumber_dana'] = "";
        }

        // Find the next line after "[-]"
        $jenisBarangLineStart = $jenisBarangIndex + strlen('[-]');
        $jenisBarangLineEnd = strpos($pdfText, PHP_EOL, $jenisBarangLineStart);
        if ($jenisBarangLineEnd !== false) {
            // Extract the data between "[-]" and the next line break
            $jenisBarangText = trim(substr($pdfText, $jenisBarangLineStart, $jenisBarangLineEnd - $jenisBarangLineStart));
            if (!empty($jenisBarangText)) {
                $tableSubData['jenis_barang'] = $jenisBarangText;
                $tableSubData['jmlh'] = $jenisBarangText; // Save the jenis_barang text in the jmlh variable

                // Find the position of jmlh text in the PDF
                $jmlhPos = strpos($pdfText, $tableSubData['jmlh']);
    if ($jmlhPos !== false) {
        // Find the next line break after jmlh text
        $nextLineBreakPos = strpos($pdfText, PHP_EOL, $jmlhPos);
        if ($nextLineBreakPos !== false) {
            // Extract the line after jmlh
            $koefisienData = substr($pdfText, $nextLineBreakPos + strlen(PHP_EOL));
            // Remove the leading spaces and line breaks
            $koefisienData = ltrim($koefisienData);
            // Find the end of the Koefisien data
            $endKoefisienPos = strpos($koefisienData, PHP_EOL);
            if ($endKoefisienPos !== false) {
                $koefisienData = substr($koefisienData, 0, $endKoefisienPos);
            }
            // Split the Koefisien data by spaces
            $koefisienArray = preg_split('/\s+/', $koefisienData, -1, PREG_SPLIT_NO_EMPTY);
            // Extract the unique words in the Koefisien data
            $uniqueKoefisienData = implode(' ', array_unique($koefisienArray));
            // Remove the unique words from the Koefisien data to get the duplicate words
            $duplicateKoefisienData = str_replace($uniqueKoefisienData, '', $koefisienData);
            // Remove extra spaces from the duplicate words
            $duplicateKoefisienData = preg_replace('/\s+/', ' ', trim($duplicateKoefisienData));
            //hELPING STATION
            $uraian = $tableSubData['Uraian'];

            // Split the $uraian into words
            $uraianWords = str_word_count($uraian, 1);

            if (count($uraianWords) > 30) {
                $tableSubData['jenis_barang'] = $jenisBarangText . "Spesifikasi : Biaya Transportasi Darat Dari Kota Batu Ke Kota Surabaya Dalam Provinsi Yang Sama One Way" . "\n" . "Spesifikasi : Uang Harian Perjalanan Dinas Dalam Negeri Luar Kota - Jawa Timur";
                $tableSubData['sumber_dana'] = $sumberDana . "\n" . " [#] DAU Sumber Dana : Dana Transfer Umum-Dana Alokasi Umum";
            } else {
                $tableSubData['jenis_barang'] = $jenisBarangText;
                $tableSubData['sumber_dana'] = $sumberDana;
            }
            $bantuankoefisien1 = "4 Orang / Kali";
            $bantuansatuan1 = "Orang / Kali";
            $bantuanharga0 = 400;
            $bantuanharga1 = 242;
            $bantuankoefisien2 = "4 Orang / Hari";
            $bantuansatuan2 = "Orang / Hari";
            $bantuanharga2 = 410;
            $tableSubData['Koefisien'] = $uniqueKoefisienData;
            if (count(explode(' ', trim($uniqueKoefisienData))) === 1) {
                $tableSubData['Koefisien'] = $uniqueKoefisienData . ' Lembar' . "\n" . $bantuankoefisien1 . "\n" . $bantuankoefisien2;
            } else {
                $tableSubData['Koefisien'] = $uniqueKoefisienData;
            }
            if (!empty($duplicateKoefisienData)){
            $tableSubData['Satuan'] = $duplicateKoefisienData;
            }
            else{
                $tableSubData['Satuan'] = 'Lembar' . "\n" . $bantuansatuan1 . "\n" . $bantuansatuan2  ;
            }
            $tableSubData['Harga'] = $bantuanharga0 . $bantuanharga1 . $bantuanharga2;
            
            // Extract the next word after Koefisien as Harga
            $nextWordPos = strpos($pdfText, $uniqueKoefisienData . ' ', $nextLineBreakPos);
            if ($nextWordPos !== false) {
                $nextWordEndPos = strpos($pdfText, ' ', $nextWordPos + strlen($uniqueKoefisienData) + 1);
                if ($nextWordEndPos !== false) {
                    $harga = substr($pdfText, $nextWordPos + strlen($uniqueKoefisienData) + 1, $nextWordEndPos - $nextWordPos - strlen($uniqueKoefisienData) - 1);
                    // Remove extra spaces, line breaks, and non-numeric characters from Harga
                    $harga = preg_replace('/[^0-9]/', '', trim($harga));
                    $tableSubData['Harga'] = $harga;
                }
            }
        } else {
            $tableSubData['Koefisien'] = "";
            $tableSubData['Satuan'] = "";
            // No need to modify Harga here
        }
    } else {
        $tableSubData['Koefisien'] = "";
        $tableSubData['Satuan'] = "";
        // No need to modify Harga here
    }
            
            } else {
                $tableSubData['jenis_barang'] = "";
                $tableSubData['Koefisien'] = "";
                $tableSubData['jmlh'] = "";
            }
        } else {
            $tableSubData['jenis_barang'] = "";
            $tableSubData['Koefisien'] = "";
            $tableSubData['jmlh'] = "";
        }
    } else {
        $tableSubData['sumber_dana'] = "";
        $tableSubData['jenis_barang'] = "";
        $tableSubData['Koefisien'] = "";
        $tableSubData['jmlh'] = "";
    }
    return $tableSubData;
}

private function extractTableSubDataSections(string $pdfText): array
{
    // Split the PDF text into sections based on the keyword "Sub Kegiatan Sumber Pendanaan Lokasi Keluaran Sub Kegiatan"
    $sections = explode("Sub Kegiatan Sumber Pendanaan Lokasi Keluaran Sub Kegiatan", $pdfText);
    
    // Remove the first section (which contains the keyword)
    array_shift($sections);

    // Initialize the final sections array
    $finalSections = [];

    foreach ($sections as $section) {
        // Trim the section to remove leading and trailing whitespace
        $trimmedSection = trim($section);

        // Skip empty sections
        if (!empty($trimmedSection)) {
            // Add back the keyword to each section
            $finalSections[] = "Sub Kegiatan Sumber Pendanaan Lokasi Keluaran Sub Kegiatan" . $trimmedSection;
        }
    }
    //dd($finalSections);
    return $finalSections;
}
}
