@vite(['resources/css/app.css', 'resources/js/app.js'])

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm sticky-top">
  <div class="container">
    {{-- Logo & Brand --}}
    <a class="navbar-brand d-flex align-items-center fw-bold" href="{{ url('/') }}">
      <img src="{{ asset('img/logo.png') }}" alt="Logo" width="40" height="40" class="me-2 rounded-circle">
      <span>Desa Telaga Sari</span>
    </a>

    {{-- Toggler --}}
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" 
      data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    {{-- Navbar Items --}}
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fw-semibold">

        {{-- Beranda --}}
        <li class="nav-item">
          <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
            <i class="bi bi-house-door-fill me-1"></i>Beranda
          </a>
        </li>

        {{-- Profil --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="profilDropdown" role="button" 
             data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-vcard me-1"></i>Profil Desa
          </a>
          <ul class="dropdown-menu shadow border-0 rounded-3" aria-labelledby="profilDropdown">
            <li><a class="dropdown-item" href="{{ url('/profil') }}">Sejarah</a></li>
            <li><a class="dropdown-item" href="{{ url('/profil#VisiMisi') }}">Visi & Misi</a></li>
            <li><a class="dropdown-item" href="{{ url('/profil#Peta') }}">Peta & Wilayah</a></li>
            <li><a class="dropdown-item" href="{{ url('/struktur') }}">Perangkat Desa</a></li>
            <li><a class="dropdown-item" href="{{ url('/penduduk') }}">Data Penduduk</a></li>
          </ul>
        </li>

        {{-- Layanan --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="layananDropdown" role="button" 
             data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-clipboard-data me-1"></i>Layanan
          </a>
          <ul class="dropdown-menu shadow border-0 rounded-3" aria-labelledby="layananDropdown">
            <li><a class="dropdown-item" href="{{ url('/masyarakat') }}">Layanan Masyarakat</a></li>
            <li><a class="dropdown-item" href="{{ url('/kesehatan') }}">Layanan Kesehatan</a></li>
          </ul>
        </li>

        {{-- Berita & Kegiatan --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="beritaDropdown" role="button" 
             data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-newspaper me-1"></i>Berita & Kegiatan
          </a>
          <ul class="dropdown-menu shadow border-0 rounded-3" aria-labelledby="beritaDropdown">
            <li><a class="dropdown-item" href="{{ url('/artikel') }}">Artikel Desa</a></li>
            <li><a class="dropdown-item" href="{{ url('/agenda') }}">Agenda Kegiatan</a></li>
            <li><a class="dropdown-item" href="{{ url('/pengumuman') }}">Pengumuman</a></li>
          </ul>
        </li>

        {{-- Potensi Desa --}}
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/potensi') }}">
            <i class="bi bi-globe-asia-australia me-1"></i>Potensi Desa
          </a>
        </li>

        {{-- Galeri --}}
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/galeri') }}">
            <i class="bi bi-images me-1"></i>Galeri
          </a>
        </li>

        {{-- Login Button --}}
        <li class="nav-item ms-lg-2">
          <a class="btn btn-light btn-sm px-3 text-primary fw-semibold shadow-sm mt-1" href="/login">
            <i class="bi bi-box-arrow-in-right me-1"></i>Login
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
