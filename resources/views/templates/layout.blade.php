<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIKAP | SUMSEL</title>

    {{-- sweetalert --}}
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('img/logo_sumsel.webp') }}" sizes="64x64">

    {{-- iconly --}}
    <link rel="stylesheet" crossorigin href="{{ asset('template/dist/assets/compiled/css/iconly.css') }}">
    {{-- datatable jquery --}}
    <link rel="stylesheet" crossorigin
        href="{{ asset('template/dist/assets/compiled/css/table-datatable-jquery.css') }}">
    <link rel="stylesheet"
        href="{{ asset('template/dist/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    {{--  --}}
    <link rel="stylesheet" crossorigin href="{{ asset('template/dist/assets/compiled/css/app.css') }}">
    <link rel="stylesheet" crossorigin href="{{ asset('template/dist/assets/compiled/css/app-dark.css') }}">
</head>

<body>
    <script src="{{ asset('template/dist/assets/static/js/initTheme.js') }}"></script>
    <div id="app">
        @include('templates.sidebar')
        <div id="main" class='layout-navbar navbar-fixed'>
            @include('templates.navbar')
            <div id="main-content">
                @yield('content')
            </div>
            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"></span>
                            by <a href="#">Nabilla Ramadhini</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('template/dist/assets/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('template/dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <script src="{{ asset('template/dist/assets/compiled/js/app.js') }}"></script>



    {{-- datatable jquery --}}
    <script src="{{ asset('template/dist/assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/dist/assets/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/dist/assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}">
    </script>
    <script src="{{ asset('template/dist/assets/static/js/pages/datatables.js') }}"></script>

    <!-- Need: Apexcharts -->
    <script src="{{ asset('template/dist/assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('template/dist/assets/static/js/pages/dashboard.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @stack('scripts')
</body>

</html>
