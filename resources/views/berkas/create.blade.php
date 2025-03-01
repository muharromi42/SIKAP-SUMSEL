@extends('templates.layout')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2 class="text-center mb-4">Unggah Berkas</h2>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('uploads.store') }}" method="POST" enctype="multipart/form-data"
                            id="uploadForm">
                            @csrf
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
                            <div class="form-group mb-3">
                                <label for="tahun" class="form-label">Tahun</label>
                                <select name="tahun" id="tahun" class="form-control">
                                    @for ($year = date('Y'); $year >= 2000; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Bulan -->
                            <div class="form-group mb-3">
                                <label for="bulan" class="form-label">Bulan</label>
                                <select name="bulan" id="bulan" class="form-control">
                                    @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bulan)
                                        <option value="{{ $bulan }}">{{ $bulan }}</option>
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
                                    placeholder="Masukkan NPSN Sekolah">
                            </div>

                            <!-- Nama Instansi -->
                            <div class="form-group mb-3">
                                <label for="nama_instansi" class="form-label">Nama Instansi</label>
                                <input type="text" name="nama_instansi" id="nama_instansi" class="form-control"
                                    value="{{ auth()->user()->nama_instansi }}" disabled>
                            </div>

                            <!-- File Uploads -->
                            <div class="form-group mb-3">
                                <label for="file_sptjm" class="form-label">File SPTJM</label>
                                <input type="file" name="file_sptjm" id="file_sptjm" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="file_skp" class="form-label">File SKP</label>
                                <input type="file" name="file_skp" id="file_skp" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="file_tpp" class="form-label">File Tanda Terima TPP</label>
                                <input type="file" name="file_tpp" id="file_tpp" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="file_dhbpo" class="form-label">File Daftar Hadir</label>
                                <input type="file" name="file_dhbpo" id="file_dhbpo" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="file_ekinerja" class="form-label">File E-Kinerja</label>
                                <input type="file" name="file_ekinerja" id="file_ekinerja" class="form-control" required>
                            </div>

                            <!-- Submit -->
                            <div class="d-grid">
                                <button type="submit" id="confirm-upload" class="btn btn-primary" disabled>Unggah
                                    Berkas</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Disable the submit button by default
            document.addEventListener('DOMContentLoaded', function() {
                const uploadButton = document.getElementById('confirm-upload');
                const fileInputs = document.querySelectorAll('input[type="file"]');

                // Check all file inputs
                function validateFiles() {
                    let allFilesValid = true;
                    fileInputs.forEach(input => {
                        if (!input.files.length) {
                            allFilesValid = false;
                        }
                    });
                    uploadButton.disabled = !allFilesValid; // Disable button if any file is missing
                }

                // Attach event listeners to file inputs
                fileInputs.forEach(input => {
                    input.addEventListener('change', validateFiles);
                });

                // SweetAlert confirmation on submit
                uploadButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Pastikan semua data sudah benar sebelum diunggah!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, unggah!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('uploadForm').submit();
                        }
                    });
                });

                // Initial validation
                validateFiles();
            });
        </script>
    @endpush
@endsection
