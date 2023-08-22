<!-- resources/views/imported_data.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Imported Data</title>
</head>
<body>
    <h1>Imported Data</h1>
    <table>
        <thead>
            <tr>
                <th>No SPM</th>
                <th>Tanggal SPM</th>
                <!-- Add other columns here -->
            </tr>
        </thead>
        <tbody>
            @foreach($importedData as $data)
            <tr>
                <td>{{ $data->no_spm }}</td>
                <td>{{ $data->tanggal_spm }}</td>
                <!-- Add other columns here -->
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
