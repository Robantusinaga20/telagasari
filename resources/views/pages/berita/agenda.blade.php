@extends("layouts.app")

@section("title", "Agenda Kegiatan")

@section("content")

<section class="py-5 container-fluid px-3 px-md-5" data-aos="fade-up">
  <div class="row justify-content-center">
    <div class="col-12 col-xl-10">
      <h2 class="text-primary fw-bold text-uppercase text-center" data-aos="fade-down">
        Agenda Kegiatan Desa Telaga Sari
      </h2>
      <div class="d-flex justify-content-center mt-2 mb-4" data-aos="zoom-in">
        <div style="width: 60px; height: 4px; background-color: rgb(163, 15, 15); border-radius: 2px;"></div>
      </div>

      {{-- Agenda List --}}
      <div class="bg-light py-4 px-3 px-md-4 rounded shadow-sm" data-aos="fade-up">
        <h4 class="text-center fw-bold text-primary mb-3">Kegiatan Mendatang</h4>

        <div class="list-group" data-aos="fade-up" data-aos-delay="200">
          @forelse ($agendas as $agenda)
            <div class="list-group-item d-flex align-items-center">
              {{-- Gambar --}}
              <div style="width: 280px; height: 180px; overflow: hidden; border-radius: 6px; margin-right: 15px;">
                @if ($agenda->gambar)
                  <img src="{{ asset('storage/' . $agenda->gambar) }}"
                       alt="Gambar Agenda"
                       style="width: 100%; height: 100%; object-fit: cover;">
                @else
                  <div class="bg-secondary text-white d-flex justify-content-center align-items-center"
                       style="width: 100%; height: 100%;">
                    Tidak ada gambar
                  </div>
                @endif
              </div>

              {{-- Info --}}
              <div>
                <h6 class="mb-1 fw-bold font-weight-light fs-5">{{ $agenda->name }}</h6>
                <small class="text-muted fs-6">
                  {{ \Carbon\Carbon::parse($agenda->tanggal)->locale('id')->translatedFormat('d F Y') }}
                </small>
              </div>
            </div>
          @empty
            <div class="text-center text-muted py-3">Belum ada agenda.</div>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</section>

@endsection