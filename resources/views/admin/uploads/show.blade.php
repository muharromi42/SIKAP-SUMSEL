@extends('templates.layout')

@section('content')
    <div class="container mt-4">
        <h3 class="mb-4">Detail Berkas</h3>

        {{-- Tombol Kembali --}}
        <div class="mb-4">
            <button onclick="history.go(-2)" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</button>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Informasi User</h5>
                        <p><strong>Nama User:</strong> {{ $upload->user->nama }}</p>
                        <p><strong>NIP:</strong> {{ $upload->user->nip }}</p>
                        <p><strong>Tahun:</strong> {{ $upload->tahun }}</p>
                        <p><strong>Bulan:</strong> {{ $upload->bulan }}</p>
                        <p><strong>Kabupaten:</strong> {{ $upload->kabupaten }}</p>
                        <p><strong>Nama Instansi:</strong> {{ $upload->nama_instansi }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Status Validasi</h5>
                        <p><strong>Status:</strong>
                            @if ($upload->status == 'approved')
                                <span class="badge bg-success">Disetujui</span>
                            @elseif($upload->status == 'rejected')
                                <span class="badge bg-danger">Ditolak</span>
                            @else
                                <span class="badge bg-warning">Menunggu</span>
                            @endif
                        </p>
                        <p><strong>Notes: {{ $upload->note }}</strong></p>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <h4 class="mb-3">Berkas yang Diunggah</h4>
        <div class="list-group mb-4">
            <a href="{{ asset('storage/' . $upload->file_sptjm) }}" target="_blank"
                class="list-group-item list-group-item-action">
                SPTJM
            </a>
            <a href="{{ asset('storage/' . $upload->file_skp) }}" target="_blank"
                class="list-group-item list-group-item-action">
                SKP
            </a>
            <a href="{{ asset('storage/' . $upload->file_tpp) }}" target="_blank"
                class="list-group-item list-group-item-action">
                Tanda Terima TPP
            </a>
            <a href="{{ asset('storage/' . $upload->file_dhbpo) }}" target="_blank"
                class="list-group-item list-group-item-action">
                Daftar Hadir
            </a>
            <a href="{{ asset('storage/' . $upload->file_ekinerja) }}" target="_blank"
                class="list-group-item list-group-item-action">
                E-Kinerja
            </a>
        </div>

        <hr>

        <h4>Validasi Berkas</h4>
        <form action="{{ route('admin.uploads.validate', $upload->id) }}" method="POST" class="mt-3">
            @csrf
            <div class="form-group mb-3">
                <label for="status" class="form-label">Pilih Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="approved" {{ $upload->status == 'approved' ? 'selected' : '' }}>Setujui</option>
                    <option value="rejected" {{ $upload->status == 'rejected' ? 'selected' : '' }}>Tolak</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="notes">Catatan (jika berkas ditolak)</label>
                <input type="text" class="form-control" id="note" name="note" placeholder="{{ $upload->note }}">
            </div>
            <button type="submit" class="btn btn-primary">Validasi</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            @if (session('success'))
                Swal.fire({
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>
@endpush
