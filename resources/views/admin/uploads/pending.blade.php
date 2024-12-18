@extends('templates.layout')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Berkas Pending</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="pending-table" width="100%">
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
            $('#pending-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.uploads.pending') }}",
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
            $('#pending-table').on('click', '.delete-button', function(event) {
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
