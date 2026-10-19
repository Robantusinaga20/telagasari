@extends("layouts.app")

@section("title", "Tentang Program")

@section("content")
    {{-- Hero Section --}}
    <div class="hero position-relative text-center text-white d-flex align-items-center justify-content-center" 
         style="height: 65vh; background: url('{{ asset('img/bg.png') }}') center/cover no-repeat;">
        <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100" 
             style="background: rgba(0,0,0,0.5);"></div>
        <div class="hero-content position-relative">
            <h1 class="display-4 fw-bold">Tentang Program</h1>
            <p class="fs-4">Project Web Desa Telaga Sari - Kecamatan Sunggal</p>
        </div>
    </div>

    {{-- Latar Belakang --}}
    <section class="py-5 container px-3 px-md-5" data-aos="fade-up">
        <div class="row align-items-center mb-5">
            <div class="col-12 col-lg-8 mb-4 mb-lg-0" data-aos="fade-right">
                <h2 class="text-success fw-bold mb-4 text-center text-lg-start" style="font-family: Georgia, serif;">
                    Latar Belakang
                </h2>
                <p class="text-justify">
                    Di era sekarang, masyarakat makin terbiasa mencari informasi lewat internet. Sayangnya,
                    informasi tentang desa sering kali masih tersebar, bahkan ada yang belum terdokumentasi dengan baik.
                    Dari situlah muncul ide untuk membuat website desa—sebuah wadah resmi yang bisa menampung
                    berbagai informasi penting, mulai dari profil dan sejarah desa, artikel, hingga agenda kegiatan.
                </p>
                <p class="text-justify">
                    Selain jadi pusat informasi, website ini juga berfungsi untuk mendekatkan pelayanan ke masyarakat.
                    Bayangkan, warga bisa melihat jadwal posyandu, mengetahui layanan kesehatan, sampai mengurus
                    pengajuan surat tanpa harus antre di kantor desa. Jadi, website ini bukan hanya sekadar media informasi,
                    tapi juga jembatan digital antara desa dan warganya, agar komunikasi lebih terbuka, layanan lebih cepat,
                    dan potensi desa bisa dikenal lebih luas.
                </p>
            </div>
            <div class="col-12 col-lg-4 text-center" data-aos="zoom-in">
                <img src="{{ asset('img/tim/tim.jpg') }}" alt="tim"
                     class="img-fluid rounded shadow-lg mx-auto" style="max-height: 300px; object-fit: cover;">
            </div>
        </div>

        {{-- Kampus--}}
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="text-success fw-bold" style="font-family: Georgia, serif;">Informasi Kampus</h2>
        </div>
       <div class="container text-center">
                    <div class="d-flex justify-content-center flex-wrap gap-4">
                        <div class="card shadow border-0" style="width: 18rem;">
                            <img src="{{ asset('img/tim/tgd.jpg') }}" class="card-img-top rounded-top" alt="Foto 3">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">STMIK Triguna Dharma Medan</h5>
                                <a href="https://maps.app.goo.gl/v8romH777sq8vvQg7" target="_blank" class="bi bi-geo-alt mb-0 card-text text-danger text-decoration-none"><small> Jl. Pintu Air I/Jend. AH Nasution No. 73, Medan Johor</small></a><br>
                                <a href="https://trigunadharma.ac.id/" target="_blank" class="bi bi-globe-asia-australia mt-0 text-primary-emphasis text-decoration-none"> trigunadharma.ac.id</a>
                            </div>
                        </div>
                        <div class="card shadow border-0" style="width: 18rem;">
                            <img src="{{ asset('img/tim/dospen.jpg') }}" class="card-img-top rounded-top" alt="Foto 4">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">Marsono, S.Kom., M.Kom.</h5>
                                <p class="alt mb-0 card-text text-muted">Dosen Pembimbing</p>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

        {{-- Tim Pengembang --}}
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="text-success fw-bold" style="font-family: Georgia, serif;">Tim Pengembang</h2>
            <p class="text-muted">Perkenalkan kami adalah Mahasiswa/i dari kampus <strong>STMIK Triguna Dharma Medan</strong> yang telah mengembangkan Web Desa Telaga Sari
            <br>Ucapan terimakasih diberikan kepada pihak-pihak yang sudah terlibat dan membantu sehingga website ini dapat terselesaikan dengan baik.</p>
        </div>

        <div id="carouselCards" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">

                {{-- Slide 1 --}}
                <div class="carousel-item active">
                    <div class="d-flex justify-content-center flex-wrap gap-4">
                        <div class="card shadow border-0" style="width: 18rem;">
                            <img src="{{ asset('img/tim/zalu.png') }}" class="card-img-top rounded-top" alt="Foto 1">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">Rizky Aprizal Siregar</h5>
                                <p class="mb-0 card-text text-muted">Ketua | Web Programmer</p>
                                <a href="https://instagram.com/zalu.zip" target="_blank" class="bi bi-instagram mt-0 text-primary-emphasis text-decoration-none"> @zalu.zip</a>
                            </div>
                        </div>
                        <div class="card shadow border-0" style="width: 18rem;">
                            <img src="{{ asset('img/tim/banzo.png') }}" class="card-img-top rounded-top" alt="Foto 2">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">Robantu Parluhutan Sinaga</h5>
                                <p class="mb-0 card-text text-muted">Web Programmer</p>
                                <a href="https://instagram.com/srobantu" target="_blank" class="bi bi-instagram mt-0 text-primary-emphasis text-decoration-none"> @srobantu</a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Slide 2 --}}
                <div class="carousel-item">
                    <div class="d-flex justify-content-center flex-wrap gap-4">
                        <div class="card shadow border-0" style="width: 18rem;">
                            <img src="{{ asset('img/tim/cute.png') }}" class="card-img-top rounded-top" alt="Foto 3">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">Revaldo Syah Putra Barus</h5>
                                <p class="mb-0 card-text text-muted">Desain Team</p>
                                <a href="https://instagram.com/valdo_brs" target="_blank" class="bi bi-instagram mt-0 text-primary-emphasis text-decoration-none"> @valdo_brs</a>
                            </div>
                        </div>
                        <div class="card shadow border-0" style="width: 18rem;">
                            <img src="{{ asset('img/tim/zaa.png') }}" class="card-img-top rounded-top" alt="Foto 4">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">Reza Nur Haviz NST</h5>
                                <p class="mb-0 card-text text-muted">Bendahara | Desain Team</p>
                                <a href="https://instagram.com/rezanasution046" target="_blank" class="bi bi-instagram mt-0 text-primary-emphasis text-decoration-none"> @rezanasution046</a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Slide 3 --}}
                <div class="carousel-item">
                    <div class="d-flex justify-content-center flex-wrap gap-4">
                        <div class="card shadow border-0" style="width: 18rem;">
                            <img src="{{ asset('img/tim/kevin.png') }}" class="card-img-top rounded-top" alt="Foto 5">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">Kevin Gebriel Sinurat</h5>
                                <p class="mb-0 card-text text-muted">Pengelola Database</p>
                                <a href="https://instagram.com/kevin24sinurat" target="_blank" class="bi bi-instagram mt-0 text-primary-emphasis text-decoration-none"> @kevin24sinurat</a>
                            </div>
                        </div>
                        <div class="card shadow border-0" style="width: 18rem;">
                            <img src="{{ asset('img/tim/juni.jpg') }}" class="card-img-top rounded-top" alt="Foto 6">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">Juni Egiani Br Sembiring Pandia</h5>
                                <p class="mb-0 card-text text-muted">Sekretaris</p>
                                <a href="https://instagram.com/junipandiaa" target="_blank" class="bi bi-instagram mt-0 text-primary-emphasis text-decoration-none"> @junipandiaa</a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Slide 4 --}}
                <div class="carousel-item">
                    <div class="d-flex justify-content-center flex-wrap gap-4">
                        <div class="card shadow border-0" style="width: 18rem;">
                            <img src="{{ asset('img/tim/ade.png') }}" class="card-img-top rounded-top" alt="Foto 7">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">Ade Vita Insani</h5>
                                <p class="mb-0 card-text text-muted">Marketing Team</p>
                                <a href="https://instagram.com/adevitainsni_" target="_blank" class="bi bi-instagram mt-0 text-primary-emphasis text-decoration-none"> @adevitainsni_</a>
                            </div>
                        </div>
                        <div class="card shadow border-0" style="width: 18rem;">
                            <img src="{{ asset('img/tim/bitri.png') }}" class="card-img-top rounded-top" alt="Foto 8">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">Bitri Hafnisa</h5>
                                <p class="mb-0 card-text text-muted">Marketing Team</p>
                                <a href="https://instagram.com/bitrihaf_" target="_blank" class="bi bi-instagram mt-0 text-primary-emphasis text-decoration-none"> @bitrihaf_</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Navigasi Carousel --}}
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselCards" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselCards" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </section>
@endsection