@extends('templates.layout')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2 class="text-center mb-4">Edit Berkas</h2>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('uploads.update', $berkas->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Nama User -->
                            <div class="form-group mb-3">
                                <label for="nama_user" class="form-label">Nama User</label>
                                <input type="text" id="nama_user" class="form-control" value="{{ auth()->user()->nama }}"
                                    disabled>
                            </div>

                            <!-- NIP -->
                            <div class="form-group mb-3">
                                <label for="nip" class="form-label">NIP</label>
                                <input type="text" id="nip" class="form-control" value="{{ auth()->user()->nip }}"
                                    disabled>
                            </div>

                            <!-- Tahun -->
                            <!-- Tahun -->
                            <div class="form-group mb-3">
                                <label for="tahun" class="form-label">Tahun</label>
                                <select name="tahun" id="tahun" class="form-control" required>
                                    @for ($year = date('Y'); $year >= 2000; $year--)
                                        <option value="{{ $year }}"
                                            @if ($year == $berkas->tahun) selected @endif>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Bulan -->
                            <div class="form-group mb-3">
                                <label for="bulan" class="form-label">Bulan</label>
                                <select name="bulan" id="bulan" class="form-control" required>
                                    @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bulan)
                                        <option value="{{ $bulan }}"
                                            @if ($bulan == $berkas->bulan) selected @endif>
                                            {{ $bulan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Kabupaten -->
                            <div class="form-group mb-3">
                                <label for="kabupaten" class="form-label">Kabupaten / Kota</label>
                                <input type="text" name="kabupaten" id="kabupaten" class="form-control"
                                    value="{{ auth()->user()->kabupaten }}" disabled>
                            </div>

                            <!-- NPSN Sekolah -->
                            <div class="form-group mb-3">
                                <label for="npsn_sekolah" class="form-label">NPSN Sekolah (Opsional)</label>
                                <input type="text" name="npsn_sekolah" id="npsn_sekolah" class="form-control"
                                    value="{{ $berkas->npsn_sekolah }}" placeholder="Masukkan NPSN Sekolah">
                            </div>

                            <!-- Nama Instansi -->
                            <div class="form-group mb-3">
                                <label for="nama_instansi" class="form-label">Nama Instansi</label>
                                <input type="text" name="nama_instansi" id="nama_instansi" class="form-control"
                                    value="{{ auth()->user()->nama_instansi }}" disabled>
                            </div>

                            <!-- Menampilkan File Lama -->
                            @foreach (['sptjm', 'skp', 'tpp', 'dhbpo', 'ekinerja'] as $index => $file)
                                <div class="form-group mb-3">
                                    <label for="file_{{ $file }}" class="form-label">File
                                        {{ $namafile[$index] }}</label>
                                    @if ($berkas->{'file_' . $file})
                                        <p>File Lama: <a href="{{ asset('storage/' . $berkas->{'file_' . $file}) }}"
                                                target="_blank">Lihat File Lama</a></p>
                                    @endif
                                    <input type="file" name="file_{{ $file }}" id="file_{{ $file }}"
                                        class="form-control">
                                </div>
                            @endforeach

                            <!-- Submit -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
