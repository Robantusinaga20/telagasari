@extends("layouts.app")

@section("title", "Pengumuman Desa")

@section("content")
<section class="py-5 container-fluid px-3 px-md-5" data-aos="fade-up">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">

            <h2 class="text-primary fw-bold text-uppercase text-center" data-aos="fade-down">
                Pengumuman Desa Telaga Sari
            </h2>
            <div class="d-flex justify-content-center mt-2 mb-4" data-aos="zoom-in">
                <div style="width: 60px; height: 4px; background-color: rgb(163, 15, 15); border-radius: 2px;"></div>
            </div>

            @php
                $groupedPengumuman = $pengumumans->groupBy('kategori');
            @endphp

            @forelse ($groupedPengumuman as $kategori => $items)
                <div class="mb-5">
                    <h4 class="fw-bold text-success text-center mb-3">{{ ucfirst($kategori) }}</h4>

                    {{-- Bungkus carousel dengan background --}}
                    <div class="p-4 rounded shadow-sm bg-light">
                        <div id="carouselKategori{{ $loop->index }}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">

                                @foreach ($items as $item)
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        <div class="d-flex justify-content-center">
                                            <div class="card shadow border-0 text-center" style="max-width: 600px; width: 100%;">
                                                <div class="card-body">
                                                    <h5 class="text-primary fs-4 fw-bold">{{ $item->judul }}</h5>
                                                    <small class="text-muted d-block mb-2">
                                                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                                                    </small>
                                                    <p class="mb-3 text-muted">
                                                        {{ \Illuminate\Support\Str::limit(strip_tags($item->isi), 120) }}
                                                    </p>
                                                    <a href="{{ route('pengumuman.show', $item->id) }}" class="btn btn-sm btn-outline-primary">
                                                        Baca Selengkapnya
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                            {{-- Kontrol Carousel --}}
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselKategori{{ $loop->index }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Sebelumnya</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselKategori{{ $loop->index }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Selanjutnya</span>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted">Belum ada Pengumuman.</div>
            @endforelse

        </div>
    </div>
</section>
@endsection
