<!DOCTYPE html>
<html>

<head>
    <title>Data Approved</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Data yang Disetujui</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($query_data as $key => $data)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $data->nama_user }}</td> <!-- Sesuaikan nama kolom -->
                    <td>{{ $data->status }}</td>
                    <td>{{ $data->created_at->format('d-m-Y') }}</td> <!-- Sesuaikan format -->
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
