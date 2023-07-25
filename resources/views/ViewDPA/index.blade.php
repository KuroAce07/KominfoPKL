<!DOCTYPE html>
<html>
<head>
    <title>PDF Texts</title>
</head>
<body>
    <h1>PDF Texts</h1>
    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('upload.pdf') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="pdf" accept=".pdf">
        <button type="submit">Upload PDF</button>
    </form>

    <br>

    <table border="1">
        <thead>
            <tr>
                <th>PDF File Name</th>
                <th>Extracted Text</th>
                <th>Uploaded At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pdfTexts as $pdfText)
                <tr>
                    <td>{{ $pdfText->pdf_file }}</td>
                    <td>{{ $pdfText->extracted_text }}</td>
                    <td>{{ $pdfText->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
