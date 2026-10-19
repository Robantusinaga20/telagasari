@vite(['resources/css/app.css', 'resources/js/app.js'])

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm sticky-top">
  <div class="container">
    {{-- Logo & Brand --}}
    <a class="navbar-brand d-flex align-items-center fw-bold" href="{{ url('/dashboard') }}">
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

        {{-- Dashboard --}}
        <li class="nav-item">
          <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard">
            <i class="bi bi-house-door-fill me-1"></i>Dashboard
          </a>
        </li>

        {{-- Publikasi --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="publikasiDropdown" role="button" 
            data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-vcard me-1"></i>Publikasi
          </a>
          <ul class="dropdown-menu shadow border-0 rounded-3" aria-labelledby="publikasiDropdown">
            <li><a class="dropdown-item" href="{{ url('/admin-artikel') }}">Artikel Desa</a></li>
            <li><a class="dropdown-item" href="{{ url('/admin-agenda') }}">Agenda</a></li>
            <li><a class="dropdown-item" href="{{ url('/admin-pengumuman') }}">Pengumuman</a></li>
          </ul>
        </li>

        {{-- Layanan --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="layananDropdown" role="button" 
            data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-clipboard-data me-1"></i>Layanan
          </a>
          <ul class="dropdown-menu shadow border-0 rounded-3" aria-labelledby="layananDropdown">
            <li><a class="dropdown-item" href="{{ url('/suratket') }}">Ajuan Surat Keterangan</a></li>
            <li><a class="dropdown-item" href="{{ url('/suratpengantar') }}">Ajuan Surat Pengantar</a></li>
            <li><a class="dropdown-item" href="{{ url('/suratpengadu') }}">Ajuan Pengaduan</a></li>
            <li><a class="dropdown-item" href="{{ url('/kritsar') }}">Kritik & Saran</a></li>
            <li><a class="dropdown-item" href="{{ url('/admin-posyandu') }}">Data Posyandu</a></li>
          </ul>
        </li>

        {{-- Potensi Desa --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="potensiDropdown" role="button" 
            data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-globe-asia-australia me-1"></i>Potensi Desa
          </a>
          <ul class="dropdown-menu shadow border-0 rounded-3" aria-labelledby="potensiDropdown">
            <li><a class="dropdown-item" href="{{ url('/peternakan') }}">Data Peternakan</a></li>
            <li><a class="dropdown-item" href="{{ url('/perkebunan') }}">Data Perkebunan</a></li>
          </ul>
        </li>

        {{-- Kelola --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="kelolaDropdown" role="button" 
            data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-gear me-1"></i>Kelola
          </a>
          <ul class="dropdown-menu shadow border-0 rounded-3" aria-labelledby="kelolaDropdown">
            <li><a class="dropdown-item" href="{{ url('/admin-prktdesa') }}">Data Perangkat Desa</a></li>
            <li><a class="dropdown-item" href="{{ url('/admin-penduduk') }}">Data Penduduk</a></li>
            <li><a class="dropdown-item" href="{{ url('/admin-pekerjaan') }}">Data Pekerjaan</a></li>
            <li><a class="dropdown-item" href="{{ url('/admin-usia') }}">Data Usia</a></li>
            <li><a class="dropdown-item" href="{{ url('/admin-galeri') }}">Data Galeri</a></li>
            <li><a class="dropdown-item" href="{{ url('/admin-user') }}">Data Akun</a></li>
          </ul>
        </li>

        {{-- Notifikasi --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="layananDropdown" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            <div class="notification-wrapper">
              <i class="bi bi-bell-fill me-1"></i>

              {{-- Badge jumlah notifikasi --}}
              @if($totalNotifikasi > 0)
                  <span class="notification-badge">
                      {{ $totalNotifikasi }}
                  </span>
              @endif
            </div>
          </a>

          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="layananDropdown" style="width: 300px;">
            <li><span class="dropdown-item text-muted">Kelola Surat</span></li>
              <li><hr class="dropdown-divider"></li>
              @if($totalNotifikasi > 0)
                  @foreach($notifikasiList as $notif)
                      <li>
                          <a class="dropdown-item d-flex justify-content-between align-items-center" 
                            href="{{ $notif->route }}">
                              <div>
                                  <strong>{{ $notif->name }}</strong><br>
                                  <small>{{ $notif->keterangan }}</small>
                              </div>
                              <span class="badge bg-warning text-dark">{{ ucfirst($notif->status) }}</span>
                          </a>
                      </li>
                      <li><hr class="dropdown-divider"></li>
                  @endforeach
              @else
                  <li>
                      <span class="dropdown-item text-muted">Tidak ada notifikasi</span>
                  </li>
              @endif
          </ul>
      </li>

        {{-- Logout Button --}}
        <li class="nav-item ms-lg-2">
          <form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-light btn-sm px-3 text-danger fw-semibold shadow-sm mt-1">
              <i class="bi bi-box-arrow-right me-1"></i>Logout
            </button>
          </form>
        </li>

      </ul>
    </div>
  </div>
</nav>
