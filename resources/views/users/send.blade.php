@extends('templates.layout')
@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

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
                    Akun Sudah Mengirim Berkas
                </h5>
            </div>
            <div class="card-body">
                <button type="submit" class="btn rounded-pill btn-success m-2">
                    Cetak PDF
                </button>
                <div class="table-responsive">
                    <table class="table" id="table-1" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>No Telepon</th>
                                <th>NIP</th>
                                <th>Status</th>
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
                    ajax: "{{ route('usersend') }}",
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
                            data: 'notel',
                            name: 'notel'
                        },
                        {
                            data: 'nip',
                            name: 'nip'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                    ]
                });
            });
        </script>
    @endpush
@endsection
