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
                    <h3>FAQ (Frequently Asked Questions)</h3>
                    <p class="text-subtitle text-muted">Pertanyaan yang sering diajukan oleh pengguna.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">FAQ</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Frequently Asked Questions</h4>
                        </div>
                        <div class="card-body">
                            <div class="accordion" id="faqAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="faqHeadingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faqCollapseOne" aria-expanded="true"
                                            aria-controls="faqCollapseOne">
                                            Apa itu platform ini?
                                        </button>
                                    </h2>
                                    <div id="faqCollapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="faqHeadingOne" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            Platform ini adalah aplikasi berbasis web yang memfasilitasi pengelolaan data,
                                            pengunggahan berkas, monitoring, dan pelaporan secara efisien.
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="faqHeadingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faqCollapseTwo" aria-expanded="false"
                                            aria-controls="faqCollapseTwo">
                                            Bagaimana cara mendaftar?
                                        </button>
                                    </h2>
                                    <div id="faqCollapseTwo" class="accordion-collapse collapse"
                                        aria-labelledby="faqHeadingTwo" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            Anda dapat mendaftar dengan mengklik tombol <strong>Sign Up</strong> di bawah
                                            tombol login,
                                            lalu mengisi formulir pendaftaran dengan data yang benar.
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="faqHeadingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faqCollapseThree" aria-expanded="false"
                                            aria-controls="faqCollapseThree">
                                            Bagaimana cara mengetahui deadline pengunggahan berkas?
                                        </button>
                                    </h2>
                                    <div id="faqCollapseThree" class="accordion-collapse collapse"
                                        aria-labelledby="faqHeadingThree" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            Anda dapat melihat tanggal deadline di halaman <strong>Dashboard</strong> pada
                                            bagian
                                            <em>Timeline</em> atau melalui notifikasi yang kami kirimkan.
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="faqHeadingFour">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faqCollapseFour" aria-expanded="false"
                                            aria-controls="faqCollapseFour">
                                            Apa format berkas yang diperbolehkan untuk diunggah?
                                        </button>
                                    </h2>
                                    <div id="faqCollapseFour" class="accordion-collapse collapse"
                                        aria-labelledby="faqHeadingFour" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            Format yang diperbolehkan adalah <strong>PDF (Portable Document
                                                Format),</strong>
                                            dan <strong>gambar (.jpg, .png)</strong>. Ukuran maksimal berkas adalah 10 MB.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
