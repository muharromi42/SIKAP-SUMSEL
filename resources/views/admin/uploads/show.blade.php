@extends('templates.layout')

@section('content')
    <div class="container">
        <h3>Detail Berkas</h3>
        {{-- Tombol Kembali --}}
        <a href="{{ route('admin.uploads.index') }}" class="btn btn-secondary mb-3">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        <p><strong>Nama User:</strong> {{ $upload->user->nama }}</p>
        <p><strong>NIP:</strong> {{ $upload->user->nip }}</p>
        <p><strong>Tahun:</strong> {{ $upload->tahun }}</p>
        <p><strong>Bulan:</strong> {{ $upload->bulan }}</p>
        <p><strong>Kabupaten:</strong> {{ $upload->kabupaten }}</p>
        <p><strong>Nama Instansi:</strong> {{ $upload->nama_instansi }}</p>

        <p><strong>Status Validasi:</strong>
            @if ($upload->status == 'approved')
                <span class="badge bg-success">Disetujui</span>
            @elseif($upload->status == 'rejected')
                <span class="badge bg-danger">Ditolak</span>
            @else
                <span class="badge bg-warning">Menunggu</span>
            @endif
        </p>

        <hr>
        <h4>Berkas yang Diunggah</h4>
        <ul>
            <li><a href="{{ asset('storage/' . $upload->file_sptjm) }}" target="_blank">SPTJM</a></li>
            <li><a href="{{ asset('storage/' . $upload->file_skp) }}" target="_blank">SKP</a></li>
            <li><a href="{{ asset('storage/' . $upload->file_tpp) }}" target="_blank">TPP</a></li>
            <li><a href="{{ asset('storage/' . $upload->file_dhbpo) }}" target="_blank">DHBPO</a></li>
            <li><a href="{{ asset('storage/' . $upload->file_ekinerja) }}" target="_blank">E-Kinerja</a></li>
        </ul>

        <hr>
        <h4>Validasi Berkas</h4>
        <form action="{{ route('admin.uploads.validate', $upload->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="status">Pilih Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="approved" {{ $upload->status == 'approved' ? 'selected' : '' }}>Setujui</option>
                    <option value="rejected" {{ $upload->status == 'rejected' ? 'selected' : '' }}>Tolak</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Validasi</button>
        </form>
    </div>
@endsection
