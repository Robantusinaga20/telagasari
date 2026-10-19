@extends("layouts.app")

@section("title", "Galeri")

@section("content")

<section class="py-5 container-fluid px-3 px-md-5" data-aos="fade-up">
  <div class="row justify-content-center">
    <div class="col-12 col-xl-10">
      <h2 class="text-primary fw-bold text-uppercase text-center" data-aos="fade-down">Galeri Desa Telaga Sari</h2>
      <div class="d-flex justify-content-center mt-2 mb-5" data-aos="zoom-in">
        <div style="width: 60px; height: 4px; background-color: rgb(163, 15, 15); border-radius: 2px;"></div>
      </div>

      @php
        $groupedGaleri = $galeris->groupBy('kategori');
      @endphp

      @foreach ($groupedGaleri as $kategori => $items)
        <div class="mb-5">
          <h4 class="fw-bold text-success text-center mb-3">{{ ucfirst($kategori) }}</h4>

          <div id="carousel-{{ Str::slug($kategori) }}" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              @php $counter = 0; @endphp
              @foreach ($items as $item)
                @foreach (json_decode($item->gambar) as $img)
                  <div class="carousel-item {{ $counter === 0 ? 'active' : '' }}">
                    <div class="d-flex justify-content-center align-items-center" style="height: 400px;">
                      <img src="{{ asset('storage/' . $img) }}"
                           class="img-fluid rounded-4 shadow-lg"
                           style="max-height: 100%; max-width: 100%; object-fit: contain;"
                           alt="{{ $item->ket }}">
                    </div>
                    <div class="carousel-caption d-block">
                      <div class="bg-gradient-to-t from-dark to-transparent p-2 rounded-3 shadow-sm">
                        <p class="mb-1 small text-light">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</p>
                        <p class="mb-0 fw-semibold">{{ $item->ket }}</p>
                      </div>
                    </div>
                  </div>
                  @php $counter++; @endphp
                @endforeach
              @endforeach
            </div>

            <!-- Indicator dots -->
            <div class="carousel-indicators">
              @for ($i = 0; $i < $counter; $i++)
                <button type="button" data-bs-target="#carousel-{{ Str::slug($kategori) }}" 
                        data-bs-slide-to="{{ $i }}" 
                        class="{{ $i === 0 ? 'active' : '' }}" 
                        aria-current="{{ $i === 0 ? 'true' : 'false' }}"></button>
              @endfor
            </div>

            <!-- Kontrol Carousel -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ Str::slug($kategori) }}" data-bs-slide="prev">
              <span class="carousel-control-prev-icon bg-dark rounded-circle shadow-sm p-2"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ Str::slug($kategori) }}" data-bs-slide="next">
              <span class="carousel-control-next-icon bg-dark rounded-circle shadow-sm p-2"></span>
            </button>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

@endsection