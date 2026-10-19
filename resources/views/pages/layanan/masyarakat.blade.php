@extends("layouts.app")

@section("title", "Layanan Masyarakat")

@section("content")
    {{-- Hero Section --}}
    <div class="hero position-relative text-center text-white d-flex align-items-center justify-content-center" 
         style="height: 60vh; background: url('{{ asset('img/bg.png') }}') center/cover no-repeat;">
        <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100" 
             style="background: rgba(0,0,0,0.5);"></div>
        <div class="hero-content position-relative">
            <h1 class="display-4 fw-bold mt-0">Layanan Masyarakat</h1>
            <p class="fs-4 mb-1">Desa Telaga Sari, Kecamatan Sunggal - Kabupaten Deli Serdang</p>
        </div>
    </div>

    {{-- Bar Periksa Surat --}}
    <div id="Cari" class="container py-5">
        <h3 class="mb-3 text-center">Periksa Status Surat Ajuan</h3>
        <form id="searchForm" class="row g-2 justify-content-center mb-4">
            <div class="col-md-4">
                <input id="searchInput" class="form-control" type="search" placeholder="Masukkan No Surat" aria-label="Search">
            </div>
            <div class="col-md-3">
                <select id="jenSurat" class="form-select" required>
                    <option value="" disabled selected>Pilih Jenis Surat</option>
                    @foreach($jenisSurat as $jenis)
                        <option value="{{ $jenis }}">{{ $jenis }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-auto d-grid gap-1 d-md-flex justify-content-md-end">
                <button class="btn btn-success" type="submit">
                    <i class="bi bi-search"></i> Cari
                </button>
            </div>
        </form>

        <!-- Hasil pencarian -->
        <div id="searchResult" style="display:none;">
            <h3 class="mb-3">Hasil Pencarian:</h3>
            <div id="resultContent"></div>
        </div>
    </div>

    {{-- Layanan Section --}}
    <section class="py-5 container" data-aos="fade-up">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-center">

            <!-- Card 1 -->
            <div class="col">
                <div class="card bg-primary shadow-sm h-100 border-0 text-center text-white p-4 service-card">
                    <div class="card-body">
                        <i class="bi bi-file-earmark-text fs-1 text-white mb-3"></i>
                        <h5 class="card-title fw-bold">Surat Keterangan</h5>
                        <p class="mb-0">Pengajuan SKTM, Surat Usaha, Surat Mandah, SK Camat, dll.</p>
                        <a href="{{ url('/fsuratket') }}" class="btn btn-light mt-4 text-decoration-none">Ajukan Surat</a>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col">
                <div class="card bg-info shadow-sm h-100 border-0 text-center text-white p-4 service-card">
                    <div class="card-body">
                        <i class="bi bi-person-vcard fs-1 text-white mb-3"></i>
                        <h5 class="card-title fw-bold">Surat Pengantar</h5>
                        <p class="mb-0">Pengajuan Surat Pengantar Kartu Keluarga & KTP.</p>
                        <a href="{{ url('/fsuratpengantar') }}" class="btn btn-light mt-4 text-decoration-none">Ajukan Surat</a>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col">
                <div class="card bg-success shadow-sm h-100 border-0 text-center text-white p-4 service-card">
                    <div class="card-body">
                        <i class="bi bi-chat-dots fs-1 text-white mb-3"></i>
                        <h5 class="card-title fw-bold">Layanan Pengaduan</h5>
                        <p class="mb-3">Buat pengaduan atau berikan kritik & saran untuk layanan Desa.</p>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ url('/fsuratpengadu') }}" class="btn btn-light text-decoration-none">Pengaduan</a>
                            <a href="{{ url('/fsuratkritsar') }}" class="btn btn-light text-decoration-none">Kritik Saran</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('scripts')
    <script>
    document.getElementById('searchForm').addEventListener('submit', function(e) {
        e.preventDefault();

        let id = document.getElementById('searchInput').value.trim();
        let jenSurat = document.getElementById('jenSurat').value;

        if (!id || !jenSurat) {
            alert('Masukkan Nomor Surat dan pilih Jenis Surat!');
            return;
        }

        fetch(`/cari-surat?id=${id}&jen_surat=${encodeURIComponent(jenSurat)}`)
            .then(response => response.json())
            .then(data => {
                let resultDiv = document.getElementById('searchResult');
                let content = '';

                if (data.error) {
                    content = `<div class="alert alert-danger">${data.error}</div>`;
                } else {
                    // Siapkan tombol unduh jika suratket / suratpengantar
                    let downloadBtn = '';
                    if (data.tipe === 'suratket' || data.tipe === 'suratpengantar') {
                        downloadBtn = `
                            <a href="/surat/${data.tipe}/${data.id}/download" 
                            class="btn btn-success mt-2">
                                <i class="bi bi-download"></i> Unduh Pengajuan
                            </a>`;
                    }

                    content = `
                        <div class="card shadow p-3 border-success">
                            <p><strong>No Surat:</strong> ${data.id}</p>
                            <p><strong>Jenis Surat:</strong> ${data.jen_surat}</p>
                            <p><strong>Tanggal Pengajuan:</strong> 
                                ${new Date(data.created_at).toLocaleDateString('id-ID')}
                            </p>
                            <p><strong>Nama Pemohon:</strong> ${data.name}</p>
                            <p><strong>Status:</strong> 
                                <span class="badge ${data.status === 'Dikonfirmasi' ? 'bg-success' : 'bg-warning'}">
                                    ${data.status}
                                </span>
                            </p>
                            ${downloadBtn}
                        </div>
                    `;
                }

                resultDiv.style.display = 'block';
                document.getElementById('resultContent').innerHTML = content;
                resultDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
            })
            .catch(error => console.error('Fetch error:', error));
    });
    </script>
@endsection