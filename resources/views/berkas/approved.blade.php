@extends('templates.layout')

@section('content')


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
                    Validasi Berkas
                </h5>
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
    @push('scripts')
        <script type="text/javascript">
            $(function() {
                var table = $('#approved-table').DataTable({
                    processing: true,
                    serverSide: true,
                    scrollX: true,
                    ajax: "{{ route('berkas.approved') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            searchable: false
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
                            name: 'kabupaten',
                        },
                        {
                            data: 'status',
                            name: 'status',
                        }
                    ]
                });
            });
        </script>
    @endpush
@endsection
