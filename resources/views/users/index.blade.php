@extends('templates.layout')
@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    {{-- <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>DataTable jQuery</h3>
                    <p class="text-subtitle text-muted">Powerful interactive tables with datatables (jQuery
                        required).</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">DataTable jQuery</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div> --}}


    <!-- Basic Tables start -->
    <section class="section">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    jQuery Datatable
                </h5>
            </div>
            <div class="card-body">
                <button class="btn rounded-pill btn-success m-2" data-bs-toggle="modal" data-bs-target="#tambahuser">
                    Tambah User
                </button>
                <div class="table-responsive">
                    <table class="table" id="table-1" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>NIP</th>
                                <th>Level</th>
                                <th>Status</th>
                                <th>Tanggal Registrasi</th>
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
    <!-- Basic Tables end -->
    </div>

    @include('users.create')
    @include('users.edit')


    @push('scripts')
        <script type="text/javascript">
            $(function() {
                var table = $('#table-1').DataTable({
                    processing: true,
                    serverSide: true,
                    scrollX: true,
                    ajax: "{{ route('users.index') }}",
                    columns: [{

                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            searchable: false
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'nip',
                            name: 'nip'
                        },
                        {
                            data: 'level',
                            name: 'level'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'tanggal_registrasi',
                            name: 'tanggal_registrasi',
                            render: function(data, type, row) {
                                if (data) {
                                    // Format Tanggal (contoh: 25 November 2024)
                                    var date = new Date(data);
                                    var options = {
                                        year: 'numeric',
                                        month: 'long',
                                        day: 'numeric'
                                    };
                                    return date.toLocaleDateString('id-ID', options);
                                }
                                return '';
                            }
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });
                // menambahkan sweetalert2 untuk konfirmasi delete button
                $('#table-1').on('click', '.delete-button', function(event) {
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
            });

            $(document).on('click', '.edit-button', function() {
                var id = $(this).data('id');
                console.log('ID pengguna:', id);

                $.get('/users/' + id, function(data) {
                    console.log('Data diterima:', data);

                    // Isi data ke dalam modal
                    $('#edit-nama').val(data.nama);
                    $('#edit-email').val(data.email);
                    $('#edit-nip').val(data.nip);
                    $('#edit-level').val(data.level);
                    $('#edit-status').val(data.status);

                    // Atur action form
                    $('#editForm').attr('action', '/users/' + id);

                    // Tampilkan modal
                    console.log('Modal akan ditampilkan');
                    $('#edituser').modal('show');
                }).fail(function() {
                    alert('Terjadi kesalahan.');
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
        </script>
    @endpush
@endsection
