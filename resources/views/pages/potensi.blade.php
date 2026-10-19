@extends("layouts.app")

@section("title", "Potensi Desa")

@section("content")
    {{-- Hero Section --}}
    <div class="hero position-relative text-center text-white d-flex align-items-center justify-content-center" 
         style="height: 65vh; background: url('{{ asset('img/bg.png') }}') center/cover no-repeat;">
        <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100" 
             style="background: rgba(0,0,0,0.55);"></div>
        <div class="hero-content position-relative">
            <h1 class="display-4 fw-bold animate__animated animate__fadeInDown">Potensi Desa Telaga Sari</h1>
            <p class="animate__animated animate__fadeInUp">
                Desa Telaga Sari, Kecamatan Sunggal - Kabupaten Deli Serdang <br> 
                menjadi salah satu desa berkembang yang penduduknya rata-rata menekuni bidang 
                <span class="fw-bold text-warning">Peternakan</span> dan <span class="fw-bold text-success">Perkebunan</span>
            </p>
        </div>
    </div>

   <div class="container my-5 page-potensi">
    <div class="row g-4">
        {{-- Kolom kiri: Video --}}
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden h-100">
                <div class="card-header bg-primary text-white text-center fw-bold">
                    🎬 Film PKK Desa Telaga Sari
                </div>
                <div class="ratio ratio-16x9">
                    <video id="videoPlayer" class="w-100 h-100 rounded-bottom" controls preload="metadata"
                        poster="{{ asset('img/thumbnail1.png') }}">
                        <source src="{{ asset('videos/pkk_final.mp4') }}" type="video/mp4">
                        Browser Anda tidak mendukung pemutar video.
                    </video>
                </div>
            </div>
        </div>

        {{-- Kolom kanan --}}
        <div class="col-lg-4 d-flex flex-column gap-4">
            {{-- Data Peternakan --}}
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-success text-white fw-bold">🐄 DATA PETERNAKAN</div>
                <div class="card-body d-flex justify-content-around flex-wrap gap-3">
                    @foreach($peternakans as $peternakan)
                        <div class="position-relative text-center potensi-card p-2">
                            <img src="{{ asset('storage/'.$peternakan->gambar) }}" 
                                alt="{{ $peternakan->jen_ternak }}" 
                                data-category="{{ strtolower($peternakan->jen_ternak) }}"
                                class="rounded-circle img-fluid border border-3 border-success potensi-img shadow-sm clickable-potensi">
                            <h6 class="mt-2 fw-bold">{{ $peternakan->jen_ternak }}</h6>
                            <div class="overlay-info p-2 rounded-3">
                                <small>🐮 Populasi: {{ $peternakan->pop_ternak }} ekor</small><br>
                                <small>👨‍🌾 Pemilik: {{ $peternakan->jlh_pemilik }} orang</small>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Data Perkebunan --}}
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-warning fw-bold">🌱 DATA PERKEBUNAN</div>
                <div class="card-body d-flex justify-content-around flex-wrap gap-3">
                    @foreach($perkebunans as $perkebunan)
                        <div class="position-relative text-center potensi-card p-2">
                            <img src="{{ asset('storage/'.$perkebunan->gambar) }}" 
                                alt="{{ $perkebunan->jen_tanaman }}" 
                                data-category="{{ strtolower($perkebunan->jen_tanaman) }}"
                                class="rounded-circle img-fluid border border-3 border-warning potensi-img shadow-sm clickable-potensi">
                            <h6 class="mt-2 fw-bold">{{ $perkebunan->jen_tanaman }}</h6>
                            <div class="overlay-info p-2 rounded-3">
                                <small>📏 Luas: {{ $perkebunan->luas }} ha</small><br>
                                <small>🌾 Panen: {{ $perkebunan->jlh_panen }} ton/ha</small>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Carousel Potensi --}}
    <section class="py-5 container" id="carousel-section" data-aos="fade-up">
        <h2 class="text-primary fw-bold text-center mb-4">🌾 Galeri Potensi Desa</h2>

        @if($galeriPotensi->isNotEmpty())
            <div id="carouselPotensi" class="carousel slide" data-bs-ride="carousel">
                {{-- Indicators --}}
                <div class="carousel-indicators">
                    @php $slideIndex = 0; @endphp
                    @foreach ($galeriPotensi as $item)
                        @foreach (json_decode($item->gambar, true) ?? [] as $gambar)
                            <button type="button" data-bs-target="#carouselPotensi" 
                                data-bs-slide-to="{{ $slideIndex }}" 
                                class="{{ $slideIndex === 0 ? 'active' : '' }}"
                                aria-label="Slide {{ $slideIndex+1 }}">
                                <img src="{{ asset('storage/' . $gambar) }}" 
                                    class="d-block rounded border {{ $slideIndex === 0 ? 'border-3 border-primary' : 'border-1' }}" 
                                    style="width:50px; height:40px; object-fit:cover;">
                            </button>
                            @php $slideIndex++; @endphp
                        @endforeach
                    @endforeach
                </div>

                {{-- Items --}}
                <div class="carousel-inner shadow rounded-4">
                    @php $slideIndex = 0; @endphp
                    @foreach ($galeriPotensi as $item)
                        @foreach (json_decode($item->gambar, true) ?? [] as $gambar)
                            <div class="carousel-item {{ $slideIndex === 0 ? 'active' : '' }}"
                                data-category="{{ strtolower($item->ket) }}">
                                <div class="d-flex justify-content-center align-items-center" style="min-height: 350px; max-height: 500px;">
                                    <img src="{{ asset('storage/' . $gambar) }}"
                                        class="img-fluid rounded-4 shadow-lg border border-3 border-light"
                                        style="object-fit: cover; max-height: 100%;"
                                        alt="{{ $item->ket }}">
                                </div>
                                <div class="carousel-caption d-block bg-dark bg-opacity-75 p-3 rounded-3">
                                    <h5 class="fw-bold text-warning">
                                        📅 {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                                    </h5>
                                    <p class="mb-0">{{ $item->ket }}</p>
                                </div>
                            </div>
                            @php $slideIndex++; @endphp
                        @endforeach
                    @endforeach
                </div>

                {{-- Controls --}}
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselPotensi" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-circle p-3 shadow"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselPotensi" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-circle p-3 shadow"></span>
                </button>
            </div>
        @else
            <p class="text-center text-muted">Belum ada gambar potensi.</p>
        @endif
    </section>
</div>

{{-- Script untuk klik otomatis --}}
@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const clickableItems = document.querySelectorAll(".clickable-potensi");
    const carouselEl = document.querySelector("#carouselPotensi");
    const carousel = bootstrap.Carousel.getOrCreateInstance(carouselEl);

    clickableItems.forEach(item => {
        item.addEventListener("click", function() {
            const category = this.dataset.category.toLowerCase();
            const slides = document.querySelectorAll("#carouselPotensi .carousel-item");

            let targetIndex = 0;
            slides.forEach((slide, index) => {
                const slideCategory = slide.dataset.category?.toLowerCase() || "";
                if (slideCategory.includes(category)) {
                    targetIndex = index;
                }
            });

            // Scroll halus ke carousel
            document.querySelector("#carousel-section").scrollIntoView({ behavior: "smooth" });

            // Geser carousel ke slide target
            carousel.to(targetIndex);
        });
    });
});
</script>
@endpush
@endsection