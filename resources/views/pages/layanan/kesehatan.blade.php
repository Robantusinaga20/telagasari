@extends("layouts.app")

@section("title", "Layanan Kesehatan")

@section("content")
    {{-- Hero Section --}}
    <div class="hero position-relative text-center text-white d-flex align-items-center justify-content-center" 
         style="height: 70vh; background: url('{{ asset('img/bg.png') }}') center/cover no-repeat;">
        <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100" 
             style="background: rgba(0,0,0,0.5);"></div>
        <div class="hero-content position-relative">
            <h1 class="display-4 fw-bold mt-0">Layanan Kesehatan</h1>
            <p class="fs-4 mb-1">Desa Telaga Sari, Kecamatan Sunggal - Kabupaten Deli Serdang</p>
            <small>Cek Jadwal dan Lokasi diadakannya kegiatan Posyandu Desa Telaga Sari</small>
        </div>
    </div>

    {{-- Jadwal Posyandu --}}
    <section class="py-5 bg-light" data-aos="fade-up">
        <div class="container">
            <h2 class="text-center fw-bold text-primary">Jadwal Posyandu</h2>
            <div class="d-flex justify-content-center mt-2 mb-4">
                <div style="width: 80px; height: 4px; background-color: #dc3545; border-radius: 2px;"></div>
            </div>

            <div class="row g-4">
                {{-- Posyandu Balita --}}
                @foreach($posyanduBalita as $posyandu)
                    <div class="col-md-4">
                        <div class="card shadow-sm border-0 rounded-4 h-100">
                            <div class="card-body text-center p-4">
                                <div class="mb-3 text-success">
                                    <i class="bi bi-emoji-smile fs-1"></i>
                                </div>
                                <h5 class="fw-bold text-dark mb-3">{{ $posyandu->name }}</h5>
                                <p class="mb-2"><i class="bi bi-calendar-event-fill me-2 text-danger"></i><strong>Tanggal: {{ $posyandu->tanggal }}/bulan</strong></p>
                                <p class="mb-2"><i class="bi bi-geo-alt-fill me-2 text-primary"></i>Lokasi: {{ $posyandu->alamat }}</p>
                                <span class="badge bg-success px-3 py-2 rounded-pill">Balita</span>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- Posyandu Ibu Hamil --}}
                @foreach($posyanduIbu as $posyandu)
                    <div class="col-md-4">
                        <div class="card shadow-sm border-0 rounded-4 h-100">
                            <div class="card-body text-center p-4">
                                <div class="mb-3 text-danger">
                                    <i class="bi bi-heart-fill fs-1"></i>
                                </div>
                                <h5 class="fw-bold text-dark mb-3">{{ $posyandu->name }}</h5>
                                <p class="mb-2"><i class="bi bi-calendar-event-fill me-2 text-danger"></i><strong>Tanggal: {{ $posyandu->tanggal }}/bulan</strong></p>
                                <p class="mb-2"><i class="bi bi-geo-alt-fill me-2 text-primary"></i>Lokasi: {{ $posyandu->alamat }}</p>
                                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Ibu Hamil</span>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- Posyandu Lansia --}}
                @foreach($posyanduLansia as $posyandu)
                    <div class="col-md-4">
                        <div class="card shadow-sm border-0 rounded-4 h-100">
                            <div class="card-body text-center p-4">
                                <div class="mb-3 text-info">
                                    <i class="bi bi-person fs-1"></i>
                                </div>
                                <h5 class="fw-bold text-dark mb-3">{{ $posyandu->name }}</h5>
                                <p class="mb-2"><i class="bi bi-calendar-event-fill me-2 text-danger"></i><strong>Tanggal: {{ $posyandu->tanggal }}/bulan</strong></p>
                                <p class="mb-2"><i class="bi bi-geo-alt-fill me-2 text-primary"></i>Lokasi: {{ $posyandu->alamat }}</p>
                                <span class="badge bg-info px-3 py-2 rounded-pill">Lansia</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Galeri Posyandu --}}
<section class="py-5 container" data-aos="fade-up">
    <h2 class="text-primary fw-bold text-center mb-4">🏥 Galeri Posyandu</h2>

    @if($galeriPosyandu->isNotEmpty())
        <div id="carouselPosyandu" class="carousel slide" data-bs-ride="carousel">

            {{-- Carousel Indicators --}}
            <div class="carousel-indicators">
                @php $slideIndex = 0; @endphp
                @foreach ($galeriPosyandu as $item)
                    @foreach (json_decode($item->gambar, true) as $img)
                        <button type="button" data-bs-target="#carouselPosyandu" 
                            data-bs-slide-to="{{ $slideIndex }}" 
                            class="{{ $slideIndex === 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $img) }}" 
                                class="d-block rounded"
                                style="width:50px; height:40px; object-fit:cover;">
                        </button>
                        @php $slideIndex++; @endphp
                    @endforeach
                @endforeach
            </div>

            {{-- Carousel Items --}}
            <div class="carousel-inner shadow rounded-4">
                @php $activeSet = false; @endphp
                @foreach ($galeriPosyandu as $item)
                    @foreach (json_decode($item->gambar, true) as $img)
                        <div class="carousel-item {{ !$activeSet ? 'active' : '' }}">
                            <div class="d-flex justify-content-center align-items-center" style="height: 400px;">
                                <img src="{{ asset('storage/' . $img) }}"
                                    class="img-fluid rounded-4 shadow-lg border border-3 border-light"
                                    style="max-height: 100%; object-fit: cover;"
                                    alt="{{ $item->ket }}">
                            </div>
                            <div class="carousel-caption d-block bg-dark bg-opacity-75 p-3 rounded-3">
                                <h5 class="fw-bold text-warning">
                                    📅 {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                                </h5>
                                <p class="mb-0">{{ $item->ket }}</p>
                            </div>
                        </div>
                        @php $activeSet = true; @endphp
                    @endforeach
                @endforeach
            </div>

            {{-- Kontrol Carousel --}}
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselPosyandu" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle p-3 shadow"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselPosyandu" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle p-3 shadow"></span>
            </button>
        </div>
    @else
        <p class="text-center text-muted">Belum ada gambar posyandu.</p>
    @endif
</section>
@endsection