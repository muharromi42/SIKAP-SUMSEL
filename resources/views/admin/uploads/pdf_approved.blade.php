<!DOCTYPE html>
<html>

<head>
    <title>Data Approved</title>
    <style>
        @page {
            margin: 50px 25px;
        }

        header {
            position: fixed;
            top: -40px;
            left: 0;
            right: 0;
            height: 100px;
            text-align: center;
            line-height: 1.5;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin-top: 80px;
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
    <!-- Kop Surat -->
    <header>

        <div>
            <img src="{{ public_path('/img/sumsel.svg') }}" style="width: 80px; float: center; margin-left: 220px;">
            <h2 style="margin: 0;">PEMERINTAH PROVINSI SUMATERA SELATAN</h2>
            <h3 style="margin: 0;">DINAS PENDIDIKAN</h3>
            <h3 style="margin: 0;">Jalan Kapten A. Rivai No. 47 Palembang</h3>
            <h3 style="margin: 0;">Telp (0711) 354137 - 311089 Faxmile (0711) 31129</h3>
            <p style="margin: 5px 0;"><i>Email <u>disdik.ss@yahoo.com</u> Website <u>www.disdiksumsel.net</u></i></p>
        </div>
        <hr>
        <br>
    </header>

    <main>
        <!-- Judul -->
        <h2>{{ $judul }}</h2>

        <!-- Tabel Data -->
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Kabupaten/Kota</th>
                    <th>Instansi</th>
                    <th>SPTJM</th>
                    <th>SKP</th>
                    <th>TPP</th>
                    <th>DHBPO</th>
                    <th>E-KINERJA</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($query_data as $key => $data)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $data->nama_user }}</td>
                        <td>{{ $data->nip }}</td>
                        <td>{{ $data->kabupaten }}</td>
                        <td>{{ $data->nama_instansi }}</td>
                        <td>
                            @if ($data->status == 'rejected')
                                tidak lengkap
                            @elseif ($data->status == 'pending')
                                tidak lengkap
                            @else
                                lengkap
                            @endif
                        </td>
                        <td>
                            @if ($data->status == 'rejected')
                                tidak lengkap
                            @elseif ($data->status == 'pending')
                                tidak lengkap
                            @else
                                lengkap
                            @endif
                        </td>
                        <td>
                            @if ($data->status == 'rejected')
                                tidak lengkap
                            @elseif ($data->status == 'pending')
                                tidak lengkap
                            @else
                                lengkap
                            @endif
                        </td>
                        <td>
                            @if ($data->status == 'rejected')
                                tidak lengkap
                            @elseif ($data->status == 'pending')
                                tidak lengkap
                            @else
                                lengkap
                            @endif
                        </td>
                        <td>
                            @if ($data->status == 'rejected')
                                tidak lengkap
                            @elseif ($data->status == 'pending')
                                tidak lengkap
                            @else
                                lengkap
                            @endif
                        </td>
                        <td>{{ $data->bulan }}</td>
                        <td>{{ $data->tahun }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>

</html>
