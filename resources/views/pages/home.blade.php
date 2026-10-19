@extends("layouts.app")

@section("title", "Home")

@section("content")
    {{-- Hero Section --}}
    <div class="hero position-relative text-center text-white d-flex align-items-center justify-content-center" 
        style="height: 85vh; background: url('{{ asset('img/bg.png') }}') center/cover no-repeat;">
        <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100" 
            style="background: rgba(0,0,0,0.55);"></div>
        <div class="hero-content position-relative px-3">
            <p class="fs-6 fs-md-5 mb-2 animate__animated animate__fadeInDown">
                ✨ Selamat Datang di Website Resmi ✨
            </p>
            <h1 class="display-5 display-md-3 fw-bold mt-0 animate__animated animate__fadeInUp">
                Desa Telaga Sari
            </h1>
            <p class="fs-4 fs-md-5 mb-4">
                Kecamatan Sunggal - Kabupaten Deli Serdang
            </p>
            <small class="bg-light text-dark px-3 py-1 rounded-pill shadow-sm">
                Total Pengunjung Website: <span class="fw-bold">{{ $totalVisitors }}</span>
            </small>
        </div>
    </div>

    {{-- Sambutan Kepala Desa --}}
    <section class="py-5 container" data-aos="fade-up">
        <div class="row align-items-center mb-0">
            <div class="col-12 col-md-8 order-1 order-md-1" data-aos="fade-right">
                <p class="text-success fw-semibold fs-4 mb-3">
                    <i class="bi bi-chat-quote"></i> Sambutan Kepala Desa Telaga Sari
                </p>
                <div class="p-3 rounded bg-light shadow-sm">
                    <p class="text-justify mb-2">
                        Assalamualaikum warahmatullahi wabarakatuh, salam sejahtera bagi kita semua. <br>
                        Dengan penuh rasa syukur, saya menyambut seluruh warga dan pengunjung di website resmi Desa Telaga Sari. Website ini kami hadirkan sebagai wujud keterbukaan informasi dan upaya dalam memajukan desa menuju kemandirian berbasis teknologi.
                    </p>
                    <p class="text-justify mb-2">
                        Sebagai Kepala Desa, saya bersama seluruh perangkat desa berkomitmen untuk membangun Desa Telaga Sari yang mandiri, maju, dan berdaya saing dengan memanfaatkan teknologi sebagai pilar utama pembangunan.
                    </p>
                    <p class="text-justify mb-0">
                        Mari bersama-sama membangun desa yang lebih maju, sejahtera, dan berdaya saing di era digital ini.
                    </p>
                </div>
                <p class="mt-4 mb-0 fs-5 fw-bold text-dark">{{ $kepalaDesa->name ?? '-' }}</p>
                <p class="mt-0 fs-6 text-muted">{{ $kepalaDesa->jabatan ?? '-' }}</p>
            </div>

            <div class="col-12 col-md-4 text-center order-0 order-md-2 mb-4 mb-md-0" data-aos="zoom-in">
                @if ($kepalaDesa && $kepalaDesa->gambar)
                    <img src="{{ asset('storage/' . $kepalaDesa->gambar) }}" 
                         alt="{{ $kepalaDesa->name }}" 
                         class="img-fluid rounded-4 shadow-lg border border-3 border-light" 
                         style="max-width: 250px;">
                @else
                    <div class="bg-secondary text-white d-flex justify-content-center align-items-center rounded shadow" 
                         style="width: 200px; height: 250px;">
                        Tidak Ada Gambar
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Statistik Desa --}}
    <div class="container my-5">
        <div class="card shadow border-0 rounded-4">
            <div class="card-body">
                <h4 class="fw-bold mb-4 text-center text-primary">
                    <i class="bi bi-bar-chart-fill"></i> Statistik Desa
                </h4>

                <div class="row g-4">
                    {{-- Statistik Item --}}
                    <a href="{{ url('/profil#dusun') }}" class="col-md-6 col-lg-4 text-decoration-none">
                        <div class="statistik-item d-flex align-items-center p-3 border rounded-4 shadow-sm bg-light h-100 hover-shadow">
                            <div class="me-3 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                                <i class="bi bi-map fs-4"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Luas Wilayah</h6>
                                <small>315,4 ha</small>
                            </div>
                        </div>
                    </a>

                    <a href="{{ url('/profil#dusun') }}" class="col-md-6 col-lg-4 text-decoration-none">
                        <div class="statistik-item d-flex align-items-center p-3 border rounded-4 shadow-sm bg-light h-100">
                            <div class="me-3 bg-danger text-white rounded-circle d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                                <i class="bi bi-geo fs-4"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Jumlah Dusun</h6>
                                <small>{{ $penduduks->pluck('dusun')->unique()->count() }} Dusun</small>
                            </div>
                        </div>
                    </a>

                    <a href="{{ url('/penduduk#total') }}" class="col-md-6 col-lg-4 text-decoration-none">
                        <div class="statistik-item d-flex align-items-center p-3 border rounded-4 shadow-sm bg-light h-100">
                            <div class="me-3 bg-info text-white rounded-circle d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                                <i class="bi bi-people fs-4"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Jumlah Penduduk</h6>
                                <small>{{ number_format($totalPenduduk, 0, ',', '.') }} jiwa</small>
                            </div>
                        </div>
                    </a>

                    <a href="{{ url('/penduduk#total') }}" class="col-md-6 col-lg-4 text-decoration-none">
                        <div class="statistik-item d-flex align-items-center p-3 border rounded-4 shadow-sm bg-light h-100">
                            <div class="me-3 bg-warning text-white rounded-circle d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                                <i class="bi bi-house-door fs-4"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Jumlah Keluarga</h6>
                                <small>{{ number_format($totalKeluarga, 0, ',', '.') }} keluarga</small>
                            </div>
                        </div>
                    </a>

                    <a href="{{ url('/struktur') }}" class="col-md-6 col-lg-4 text-decoration-none">
                        <div class="statistik-item d-flex align-items-center p-3 border rounded-4 shadow-sm bg-light h-100">
                            <div class="me-3 bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                                <i class="bi bi-diagram-3 fs-4"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Struktur Perangkat Desa</h6>
                                <small>klik disini untuk cek Perangkat Desa</small>
                            </div>
                        </div>
                    </a>

                    <a href="{{ url('/potensi') }}" class="col-md-6 col-lg-4 text-decoration-none">
                        <div class="statistik-item d-flex align-items-center p-3 border rounded-4 shadow-sm bg-light h-100">
                            <div class="me-3 bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                                <i class="bi bi-globe-asia-australia fs-4"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Potensi Desa</h6>
                                <small>Peternakan & Perkebunan</small>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Berita Terkini --}}
    <section class="bg-light py-5" data-aos="fade-up">
        <div class="container">
            <h2 class="text-center fw-bold text-primary">Berita Terkini</h2>
            <div class="d-flex justify-content-center mt-2 mb-1">
                <div style="width: 60px; height: 4px; background-color:rgb(163, 15, 15); border-radius: 2px;"></div>
            </div>

            <div id="beritaCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($artikels->chunk(2) as $chunkIndex => $artikelChunk)
                        <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
                            <div class="row justify-content-center">
                                @foreach ($artikelChunk as $artikel)
                                    <div class="col-md-6 mb-3">
                                        <div class="card text-center h-100" style="width: 100%;" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                            <div class="card-body">
                                                @if($artikel->gambar)
                                                    <img src="{{ asset('storage/' . $artikel->gambar) }}" class="card-img-top mb-2" style="height: 180px; object-fit: cover;" alt="Gambar Artikel">
                                                @endif
                                                <h5 class="card-title text-primary">{{ $artikel->judul }}</h5>
                                                <a href="{{ route('artikel.show', $artikel->id) }}" class="btn btn-sm btn-outline-primary mt-2">Baca Selengkapnya</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#beritaCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-circle"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#beritaCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-circle"></span>
                </button>
            </div>
        </div>
    </section>

    {{-- Galeri --}}
    <section class="py-5 container" data-aos="fade-up">
        <h2 class="text-primary fw-bold text-center mb-4">📸 Galeri Desa</h2>

        @if($galeris->isNotEmpty())
            <div id="galeriCarousel" class="carousel slide" data-bs-ride="carousel">

                {{-- Carousel Indicators --}}
                <div class="carousel-indicators">
                    @php $slideIndex = 0; @endphp
                    @foreach ($galeris as $item)
                        @foreach (json_decode($item->gambar, true) as $img)
                            <button type="button" data-bs-target="#galeriCarousel" 
                                data-bs-slide-to="{{ $slideIndex }}" 
                                class="{{ $slideIndex === 0 ? 'active' : '' }}"
                                aria-current="{{ $slideIndex === 0 ? 'true' : 'false' }}">
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
                    @foreach ($galeris as $item)
                        @foreach (json_decode($item->gambar, true) as $img)
                            <div class="carousel-item {{ !$activeSet ? 'active' : '' }}">
                                <div class="d-flex justify-content-center align-items-center" style="height: 450px;">
                                    <img src="{{ asset('storage/' . $img) }}" 
                                        class="img-fluid rounded-4 shadow-lg border border-3 border-light"
                                        style="max-height: 100%; object-fit: cover;" 
                                        alt="Galeri">
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
                <button class="carousel-control-prev" type="button" data-bs-target="#galeriCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-circle p-3 shadow"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#galeriCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-circle p-3 shadow"></span>
                </button>
            </div>
        @else
            <p class="text-center text-muted">Belum ada galeri.</p>
        @endif

        {{-- Tombol Lihat Selengkapnya --}}
        <div class="text-center mt-4">
            <a href="{{ url('/galeri') }}" class="btn btn-sm btn-outline-primary mt-2">Lihat Selengkapnya</a>
        </div>
    </section>

        {{-- Agenda --}}
        <section class="py-5" data-aos="fade-up" style="background-color: #f9f9f9;">
            <div class="container">
                <h2 class="text-center fw-bold text-primary">Agenda</h2>
                <div class="d-flex justify-content-center mt-2 mb-3">
                    <div style="width: 50px; height: 3px; background-color:rgb(163, 15, 15); border-radius: 2px;"></div>
                </div>
                <p class="text-center mb-4">Kegiatan Mendatang</p>

                <div class="row g-4">
                    <!-- Kalender -->
                    <div class="col-md-6">
                        <div id="calendar" class="p-2 border rounded shadow-sm bg-white"></div>
                    </div>

                    <!-- Detail Agenda -->
                    <div class="col-md-6">
                        <div id="agenda-detail" class="card border-0 shadow-sm p-3 h-100">
                            <h6 class="fw-bold text-primary mb-2">Detail Agenda</h6>
                            <p class="text-muted small mb-1">
                                <i class="bi bi-calendar-event"></i> 
                                <span id="today-date"></span>
                            </p>
                            <p class="text-muted small">Klik tanggal pada kalender untuk melihat kegiatan desa.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @push('scripts')
            <!-- FullCalendar JS -->
            <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var calendarEl = document.getElementById('calendar');
                    var agendaDetail = document.getElementById('agenda-detail');
                    var todayDateEl = document.getElementById('today-date');

                    // Format tanggal hari ini (pakai Intl.DateTimeFormat agar konsisten)
                    var today = new Date();
                    var formatter = new Intl.DateTimeFormat('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
                    todayDateEl.innerText = formatter.format(today);

                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        locale: 'id',
                        height: 'auto',
                        selectable: true, // agar bisa klik tanggal kosong
                        events: [
                            @foreach($agendas as $agenda)
                            {
                                title: '{{ $agenda->name }}',
                                start: '{{ $agenda->tanggal }}',
                                extendedProps: {
                                    gambar: '{{ $agenda->gambar ? asset("storage/".$agenda->gambar) : "" }}',
                                    deskripsi: `{!! $agenda->deskripsi !!}`,
                                    tanggal: '{{ \Carbon\Carbon::parse($agenda->tanggal)->locale("id")->translatedFormat("d F Y") }}'
                                }
                            },
                            @endforeach
                        ],
                        eventClick: function (info) {
                            let props = info.event.extendedProps;
                            agendaDetail.innerHTML = `
                                <h6 class="fw-bold text-primary mb-2">${info.event.title}</h6>
                                <p class="text-muted small mb-1"><i class="bi bi-calendar"></i> ${props.tanggal}</p>
                                ${props.gambar ? `<img src="${props.gambar}" class="img-fluid rounded mb-2"/>` : ''}
                                <p class="small">${props.deskripsi}</p>
                            `;
                        },
                        dateClick: function (info) {
                            // cek apakah tanggal yg diklik punya event
                            var events = calendar.getEvents().filter(ev => ev.startStr === info.dateStr);
                            if (events.length === 0) {
                                agendaDetail.innerHTML = `
                                    <h6 class="fw-bold text-primary mb-2">Tidak ada kegiatan</h6>
                                    <p class="text-muted small mb-1"><i class="bi bi-calendar"></i> ${formatter.format(info.date)}</p>
                                    <p class="small text-muted">Tidak ada kegiatan hari ini.</p>
                                `;
                            }
                        }
                    });

                    calendar.render();
                });
            </script>
        @endpush
    </section>
@endsection