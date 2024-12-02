@extends('templates.layout')

@section('content')
    <h1>Daftar Berkas Unggahan</h1>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama User</th>
                <th>NIP</th>
                <th>Tahun</th>
                <th>Bulan</th>
                <th>Kabupaten</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($uploads as $upload)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $upload->nama_user }}</td>
                    <td>{{ $upload->nip }}</td>
                    <td>{{ $upload->tahun }}</td>
                    <td>{{ $upload->bulan }}</td>
                    <td>{{ $upload->kabupaten }}</td>
                    <td>
                        <a href="{{ route('admin.uploads.show', $upload->id) }}" class="btn btn-primary">Lihat</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
