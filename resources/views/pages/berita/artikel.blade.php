@extends("layouts.app")

@section("title", "Artikel Desa")

@section("content")

    <section class="py-5 container-fluid px-3 px-md-5" data-aos="fade-up">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
        <h2 class="text-primary fw-bold text-uppercase text-center" data-aos="fade-down">Artikel Desa Telaga Sari</h2>
        <div class="d-flex justify-content-center mt-2 mb-4" data-aos="zoom-in">
            <div style="width: 60px; height: 4px; background-color: rgb(163, 15, 15); border-radius: 2px;"></div>
        </div>

        <div class="list-group">
            @forelse ($artikels as $item)
                <div class="list-group-item d-flex gap-3 py-3">
                    {{-- Gambar Artikel --}}
                    <div style="width: 280px; height: 180px; overflow: hidden; border-radius: 6px;">
                        <img src="{{ asset('storage/' . $item->gambar) }}"
                            alt="Gambar Artikel"
                            style="width: 100%; height: 100%; object-fit: cover;">
                    </div>

                    {{-- Konten Artikel --}}
                    <div class="flex-fill">
                        <h6 class="mb-1 text-primary fs-4 font-weight-bold">{{ $item->judul }}</h6>
                        <small class="text-muted d-block mb-2">
                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                        </small>
                        <p class="mb-2 text-muted">
                            {{ \Illuminate\Support\Str::limit(strip_tags($item->isi), 100) }}
                        </p>
                        <a href="{{ route('artikel.show', $item->id) }}" class="btn btn-sm btn-outline-primary">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted">Belum ada artikel.</div>
            @endforelse
        </div>
    </section>

@endsection