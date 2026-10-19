@extends("layouts.app")

@section("title", "Struktur Organisasi")

@section("content")

<section class="py-5 container" data-aos="fade-up">
    {{-- Judul Halaman --}}
    <h2 class="text-primary fw-bold text-uppercase text-center" data-aos="fade-down">
        Struktur Organisasi
    </h2>
    <p class="text-primary fw-semibold text-uppercase text-center fs-4 mb-2">
        Desa Telaga Sari
    </p>
    <div class="d-flex justify-content-center mt-2 mb-5" data-aos="zoom-in">
        <div style="width: 60px; height: 4px; background-color:rgb(163, 15, 15); border-radius: 2px;"></div>
    </div>

    {{-- Sambutan Kepala Desa --}}
    <div class="row align-items-center mb-5">
        <div class="col-12 col-md-8 order-1 order-md-1" data-aos="fade-right">
            <p class="text-success fw-semibold fs-4 mb-3">
                <strong>Sambutan Kepala Desa Telaga Sari</strong>
            </p>
            <p class="text-justify mb-3">
                Assalamu’alaikum warahmatullahi wabarakatuh,<br>
                Salam sejahtera bagi kita semua,<br>
                Dengan penuh rasa syukur, saya menyambut seluruh warga dan pengunjung di website resmi Desa Telaga Sari. 
                Website ini kami hadirkan sebagai wujud keterbukaan informasi dan upaya dalam memajukan desa menuju kemandirian berbasis teknologi.<br>
                Sebagai Kepala Desa, saya bersama seluruh perangkat desa berkomitmen untuk membangun Desa Telaga Sari yang mandiri, maju, dan berdaya saing dengan memanfaatkan teknologi sebagai pilar utama pembangunan.<br>
                Melalui platform ini, kami berharap dapat memberikan kemudahan akses informasi, pelayanan yang lebih baik, serta menjadi jembatan komunikasi antara pemerintah desa dan masyarakat. 
                Mari bersama-sama membangun desa yang lebih maju, sejahtera, dan berdaya saing di era digital ini.
            </p>
            <p class="mt-3 mb-0 fs-4"><strong>{{ $kepalaDesa->name ?? '-' }}</strong></p>
            <p class="mt-0 fs-6">{{ $kepalaDesa->jabatan ?? '-' }}</p>
        </div>

        <div class="col-12 col-md-4 text-center order-0 order-md-2 mb-4 mb-md-0" data-aos="zoom-in">
            @if ($kepalaDesa && $kepalaDesa->gambar)
                <img src="{{ asset('storage/' . $kepalaDesa->gambar) }}" 
                     alt="{{ $kepalaDesa->name }}" 
                     class="img-fluid rounded shadow" 
                     style="max-width: 200px; height: 250px; object-fit: cover;">
            @else
                <div class="bg-secondary text-white d-flex justify-content-center align-items-center rounded shadow"
                     style="width: 200px; height: 250px;">
                    Tidak Ada Gambar
                </div>
            @endif
        </div>
    </div>

    <hr class="my-4">

    {{-- Sekretaris Desa --}}
    <div class="row align-items-center mb-5">
        <div class="col-12 col-md-8" data-aos="fade-right">
            <p class="text-success fw-semibold fs-4 mb-3"><strong>Sekretaris Desa</strong></p>
            @if ($sekretaris)
                <p class="mt-3 mb-0 fs-4"><strong>{{ $sekretaris->name }}</strong></p>
                <p class="mt-0 fs-6">{{ $sekretaris->jabatan }}</p>
            @else
                <p class="text-muted">Data Sekretaris belum tersedia.</p>
            @endif
        </div>

        <div class="col-12 col-md-4 text-center" data-aos="zoom-in">
            @if ($sekretaris && $sekretaris->gambar)
                <img src="{{ asset('storage/' . $sekretaris->gambar) }}" 
                     alt="{{ $sekretaris->name }}" 
                     class="img-fluid rounded shadow" 
                     style="max-width: 200px; height: 250px; object-fit: cover;">
            @else
                <div class="bg-secondary text-white d-flex justify-content-center align-items-center rounded shadow"
                     style="width: 200px; height: 250px;">
                    Tidak Ada Gambar
                </div>
            @endif
        </div>
    </div>

    <hr class="my-4">

    {{-- Kepala Urusan --}}
    <div class="row">
        <div class="col-12 mb-4">
            <p class="text-success fw-semibold fs-4 text-center"><strong>Kepala Urusan</strong></p>
        </div>
        @forelse ($kaur as $item)
            <div class="col-12 col-md-6 mb-4 d-flex" data-aos="fade-up">
                <div class="me-3">
                    @if ($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" 
                             alt="{{ $item->name }}" 
                             class="img-fluid rounded shadow" 
                             style="width: 120px; height: 160px; object-fit: cover;">
                    @else
                        <div class="bg-secondary text-white d-flex justify-content-center align-items-center rounded shadow"
                             style="width: 120px; height: 160px;">
                            Tidak Ada Gambar
                        </div>
                    @endif
                </div>
                <div>
                    <p class="mb-1 fw-bold fs-5">{{ $item->name }}</p>
                    <p class="text-muted mb-0">{{ $item->jabatan }}</p>
                </div>
            </div>
        @empty
            <div class="col-12"><p class="text-muted">Data KAUR belum tersedia.</p></div>
        @endforelse
    </div>

    <hr class="my-4">

    {{-- Kepala Seksi --}}
    <div class="row">
        <div class="col-12 mb-4">
            <p class="text-success fw-semibold fs-4 text-center"><strong>Kepala Seksi</strong></p>
        </div>
        @forelse ($kasi as $item)
            <div class="col-12 col-md-6 mb-4 d-flex" data-aos="fade-up">
                <div class="me-3">
                    @if ($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" 
                             alt="{{ $item->name }}" 
                             class="img-fluid rounded shadow" 
                             style="width: 120px; height: 160px; object-fit: cover;">
                    @else
                        <div class="bg-secondary text-white d-flex justify-content-center align-items-center rounded shadow"
                             style="width: 120px; height: 160px;">
                            Tidak Ada Gambar
                        </div>
                    @endif
                </div>
                <div>
                    <p class="mb-1 fw-bold fs-5">{{ $item->name }}</p>
                    <p class="text-muted mb-0">{{ $item->jabatan }}</p>
                </div>
            </div>
        @empty
            <div class="col-12"><p class="text-muted">Data KASI belum tersedia.</p></div>
        @endforelse
    </div>

    <hr class="my-4">

    {{-- Kepala Dusun --}}
    <div class="row">
        <div class="col-12 mb-4">
            <p class="text-success fw-semibold fs-4 text-center"><strong>Kepala Dusun</strong></p>
        </div>
        @forelse ($dusun as $item)
            <div class="col-12 col-md-6 mb-4 d-flex" data-aos="fade-up">
                <div class="me-3">
                    @if ($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" 
                             alt="{{ $item->name }}" 
                             class="img-fluid rounded shadow" 
                             style="width: 120px; height: 160px; object-fit: cover;">
                    @else
                        <div class="bg-secondary text-white d-flex justify-content-center align-items-center rounded shadow"
                             style="width: 120px; height: 160px;">
                            Tidak Ada Gambar
                        </div>
                    @endif
                </div>
                <div>
                    <p class="mb-1 fw-bold fs-5">{{ $item->name }}</p>
                    <p class="text-muted mb-0">{{ $item->jabatan }}</p>
                </div>
            </div>
        @empty
            <div class="col-12"><p class="text-muted">Data Kepala Dusun belum tersedia.</p></div>
        @endforelse
    </div>

</section>

@endsection
