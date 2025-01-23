@extends('templates.layout')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Berkas Disetujui</h5>

                <!-- Form Filter -->
                <form method="GET" action="{{ route('admin.uploads.approved.pdf') }}">
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <!-- Pilih instansi -->
                        <select name="instansi" class="form-control" style="width: 150px;">
                            <option value="">-- Pilih instansi --</option>
                            @foreach ($instansi_list as $instansi)
                                <option value="{{ $instansi }}"
                                    {{ request('instansi') == $instansi ? 'selected' : '' }}>
                                    {{ $instansi }}
                                </option>
                            @endforeach
                        </select>


                        <!-- Pilih kabupaten -->
                        <select name="kabupaten" class="form-control" style="width: 150px;">
                            <option value="">-- Pilih kabupaten --</option>
                            @foreach (['Banyuasin', 'Empat Lawang', 'Lahat', 'Lubuk Linggau', 'Muara Enim', 'Musi Banyuasin', 'Musi Rawas', 'Ogan Ilir', 'Ogan Komering Ilir', 'Ogan Komering Ulu', 'Palembang', 'Pagar Alam', 'Prabumulih'] as $kabupaten)
                                <option value="{{ $kabupaten }}"
                                    {{ request('kabupaten') == $kabupaten ? 'selected' : '' }}>
                                    {{ $kabupaten }}
                                </option>
                            @endforeach
                        </select>


                        <!-- Pilih Bulan -->
                        <select name="bulan" class="form-control" style="width: 150px;">
                            <option value="">-- Pilih Bulan --</option>
                            @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bulan)
                                <option value="{{ $bulan }}" {{ request('bulan') == $bulan ? 'selected' : '' }}>
                                    {{ $bulan }}
                                </option>
                            @endforeach
                        </select>



                        <!-- Pilih Tahun -->
                        <select name="tahun" class="form-control" style="width: 150px;">
                            <option value="">-- Pilih Tahun --</option>
                            @for ($year = date('Y'); $year >= 2000; $year--)
                                <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endfor
                        </select>

                        <!-- Tombol Filter -->
                        <button type="submit" class="btn btn-success">Cetak PDF</button>
                    </div>
                </form>

                <!-- Tombol Cetak PDF -->
                {{-- <a href="{{ route('admin.uploads.approved.pdf', request()->all()) }}" class="btn btn-success">Cetak PDF</a> --}}
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="approved-table" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama User</th>
                                <th>NIP</th>
                                <th>Tahun</th>
                                <th>Bulan</th>
                                <th>Kabupaten</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function() {
            $('#approved-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.uploads.approved') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama_user',
                        name: 'nama_user'
                    },
                    {
                        data: 'nip',
                        name: 'nip'
                    },
                    {
                        data: 'tahun',
                        name: 'tahun'
                    },
                    {
                        data: 'bulan',
                        name: 'bulan'
                    },
                    {
                        data: 'kabupaten',
                        name: 'kabupaten'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });

            // menambahkan sweetalert2 untuk konfirmasi delete button
            $('#approved-table').on('click', '.delete-button', function(event) {
                event.preventDefault();
                var form = $(this).closest('form');
                Swal.fire({
                    title: 'Yakin?',
                    text: "Kamu tidak bisa mengulangnya lagi!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: "Batal",
                    confirmButtonText: 'Ya, hapus data ini!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

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
