@extends('templates.layout')

@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Contact Us</h3>
                    <p class="text-subtitle text-muted">Hubungi kami melalui kontak di bawah ini.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contact</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4>Kontak Kami</h4>
                        </div>
                        <div class="card-body">
                            <div class="contact-list">
                                <br>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5>JUMHARI APRIANTO, ST</h5>
                                            <p class="mb-0">Nomor HP:</p>
                                        </div>
                                        <a href="https://wa.me/6282181421868" target="_blank" class="btn btn-success">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg"
                                                alt="WhatsApp" width="20" height="20" class="me-2">
                                            +62 821-8142-1868
                                        </a>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5>DWIKI YUSUF, S.H</h5>
                                            <p class="mb-0">Nomor HP:</p>
                                        </div>
                                        <a href="https://wa.me/6282289185489" target="_blank" class="btn btn-success">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg"
                                                alt="WhatsApp" width="20" height="20" class="me-2">
                                            +62 822-8918-5489
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-footer text-muted text-center">
                            <p>Terima kasih telah menghubungi kami!</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
