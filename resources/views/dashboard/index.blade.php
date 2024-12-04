@extends('templates.layout')
@section('content')
    <div class="page-heading">
        <h3>Selamat Datang, {{ Auth::user()->nama }} 👋</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon purple mb-2">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Jumlah User</h6>
                                        <h6 class="font-extrabold mb-0">{{ $userCount }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon blue mb-2">
                                            <i class="bi-box-seam"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Jumlah Berkas</h6>
                                        <h6 class="font-extrabold mb-0">{{ $berkasCount }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon green mb-2">
                                            <i class="iconly-boldAdd-User"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Berkas Diterima</h6>
                                        <h6 class="font-extrabold mb-0">{{ $approvedCount }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon red mb-2">
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Berkas Ditolak</h6>
                                        <h6 class="font-extrabold mb-0">{{ $rejectedCount }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Berkas per kabupaten</h4>
                            </div>


                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <form method="GET" action="">
                                            <select name="year" id="yearSelect" class="form-select"
                                                onchange="this.form.submit()">
                                                @for ($i = 2020; $i <= date('Y'); $i++)
                                                    <option value="{{ $i }}"
                                                        {{ $selectedYear == $i ? 'selected' : '' }}>
                                                        {{ $i }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </form>
                                    </div>
                                </div>
                                <div id="berkasChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="card-body py-4 px-4">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl">
                                <img
                                    src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : '/template/dist/assets/compiled/jpg/2.jpg' }}">
                            </div>
                            <div class="ms-3 name">
                                <h5 class="font-bold">{{ Auth::user()->nama }}</h5>
                                <h6 class="text-muted mb-0">{{ Auth::user()->nip }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Status berkas</h4>
                    </div>
                    <div class="card-body">
                        <div id="statusChart"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @push('scripts')
        <script>
            let categories = @json($categories);
            let series = @json($series);

            let options = {
                chart: {
                    type: 'bar',
                    height: 400,
                },
                series: series,
                xaxis: {
                    categories: categories,
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '100%',
                        endingShape: 'rounded',
                    },
                },
                title: {
                    text: `Jumlah Berkas per Kabupaten ({{ $selectedYear }})`,
                    align: 'center',
                    style: {
                        fontSize: '18px',
                    },
                },
                yaxis: {
                    title: {
                        text: 'Jumlah Berkas',
                    },
                },

                legend: {
                    position: 'bottom',
                },
            };

            let chart = new ApexCharts(document.querySelector("#berkasChart"), options);
            chart.render();

            var optionsDonut = {
                chart: {
                    type: 'donut',
                    height: 500, // Menentukan tinggi chart
                    width: '100%',
                },
                series: [{{ $dataBerkas['pending'] }}, {{ $dataBerkas['approved'] }},
                    {{ $dataBerkas['rejected'] }}
                ], // Data berdasarkan status
                labels: ['Pending', 'Approved', 'Rejected'], // Label untuk donut chart
                colors: ['#FFB800', '#28C76F', '#F1416C'], // Warna masing-masing status
                responsive: [{
                    breakpoint: 720, // Mengatur ukuran chart pada layar 720px
                    options: {
                        chart: {
                            width: '100%', // Agar chart mengisi lebar kontainer pada layar 720px
                            height: 400, // Mengatur tinggi chart pada layar lebih kecil
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }, {
                    breakpoint: 480, // Untuk layar lebih kecil dari 480px
                    options: {
                        chart: {
                            width: '100%',
                            height: 350, // Menyesuaikan tinggi untuk layar ponsel kecil
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]

            };

            var chartDonut = new ApexCharts(document.querySelector("#statusChart"), optionsDonut);
            chartDonut.render();
        </script>
    @endpush
@endsection
