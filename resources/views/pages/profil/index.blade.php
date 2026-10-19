@extends("layouts.app")

@section("title", "Profil Desa")

@section("content")

<section class="py-5 container-fluid px-3 px-md-5" data-aos="fade-up">
  <div class="row justify-content-center">
    <div class="col-12 col-xl-10">
      
      {{-- Judul Halaman --}}
      <h2 class="text-primary fw-bold text-uppercase text-center" data-aos="fade-down">
        <i class="bi bi-people-fill me-2"></i> Profil Desa Telaga Sari
      </h2>
      <div class="d-flex justify-content-center mt-2 mb-4" data-aos="zoom-in">
        <div style="width: 60px; height: 4px; background-color: rgb(163, 15, 15); border-radius: 2px;"></div>
      </div>

      {{-- Sejarah --}}
      <div class="row align-items-center mb-5">
        <div class="col-12 col-lg-8" data-aos="fade-right">
          <h3 class="text-success fw-semibold fs-3 mb-3" style="font-family: Georgia, serif;">
            <i class="bi bi-book-half me-2"></i> Sejarah
          </h3>
          <p class="text-justify">
            Awal mula terbentuknya Desa Telaga Sari bermula pada bulan Mei 1962 adanya perpindahan Para Petani (masyarakat) dari Patumbak ke Diaki di bawah pengawasan PT. Perkebunan Nusantara IX yang kini menjadi PT. Perkebunan Nusantara II.
            <br><br>
            Para Petani (masyarakat) berjumlah 210 KK, masing-masing mendapat 1 Patok Tanah ukuran 11.000 m² (20 m x 550 m). Terdapat 214 patok: 210 untuk warga, 4 untuk fasilitas umum seperti Balai Desa, Sekolah, Masjid, dan Lapangan.
            <br><br>
            Saat perpindahan, desa disebut Penampungan Masyarakat Medan Krio dipimpin Bapak Rabun untuk urusan administrasi hingga tahun 1963.
          </p>
        </div>
        <div class="col-12 col-lg-4 text-center mb-4 mb-lg-0" data-aos="zoom-in">
          <img src="{{ asset('img/kantor.jpg') }}" alt="Kantor Desa" class="img-fluid rounded shadow mx-auto d-block">
        </div>
      </div>

      <hr class="my-4">

      {{-- Visi & Misi --}}
      <div id="VisiMisi" class="mb-5">
        <p class="text-center text-success fw-semibold fs-3 mb-4" style="font-family: Georgia, serif;">
          <i class="bi bi-lightbulb-fill me-2"></i> Visi & Misi
        </p>

        <div class="border rounded p-4 mb-4 shadow bg-light" data-aos="fade-up">
          <h4 class="text-success fw-bold mb-3"><i class="bi bi-eye-fill me-2"></i> Visi</h4>
          <p class="fst-italic">
            <strong>"Bekerja dengan sikap melayani untuk mewujudkan Desa Telaga Sari yang lebih Maju, Sejahtera, Adil, Sehat, Berprestasi dan Kreatif melalui tata kelola pemerintahan yang Baik dan Bersinergi."</strong>
          </p>
          <p>
            Makna dan arti rumusan visi ini mengandung unsur filosofis dan tujuan visioner selama 8 tahun: 
            <strong>"Mewujudkan Desa Telaga Sari Sebagai Desa Yang Lebih Maju, Sejahtera, Adil, Sehat Serta Berprestasi Dan Kreatif."</strong>
          </p>
        </div>

        <div class="border rounded p-4 shadow bg-light-subtle" data-aos="fade-up" data-aos-delay="200">
          <h4 class="text-success fw-bold mb-3"><i class="bi bi-list-check me-2"></i> Misi</h4>
          <ol class="mb-0">
            <li>Meningkatkan tata kelola Pemerintahan yang Bersinergi.</li>
            <li>Meningkatkan Profesional dan Keaktifan seluruh Aparatur Desa.</li>
            <li>Mengedepankan Musyawarah dan Mufakat dalam penyelenggaraan Pemerintah desa.</li>
            <li>Mewujudkan pelayanan publik berbasis Teknologi Informasi.</li>
            <li>Membentuk dan membina Badan Usaha Milik Desa (BUMDES).</li>
            <li>Memperdayakan Potensi Pertanian dan Peternakan.</li>
            <li>Mengoptimalkan kinerja Lembaga Pemberdayaan Masyarakat (LPM).</li>
            <li>Mengoptimalkan kinerja PKK Desa.</li>
            <li>Meningkatkan layanan kesehatan masyarakat.</li>
            <li>Memberdayakan kreatifitas Pemuda/i melalui Karang Taruna.</li>
          </ol>
        </div>
      </div>

      <hr class="my-4">

      {{-- Peta & Wilayah --}}
      <div id="Peta" class="mb-5 text-center">
        <p class="text-success fw-semibold fs-3 mb-3"><i class="bi bi-geo-alt-fill me-2"></i> Peta & Wilayah</p>
        <a href="https://maps.app.goo.gl/JJNGqjMpGT74qaHC9" class="fw-medium fs-5 text-decoration-none text-reset mb-3 d-block" target="_blank" rel="noopener noreferrer">
          Jl. Diski Glugur Rimbun No.180
        </a>
        <div class="ratio ratio-16x9 rounded shadow mx-auto" style="max-width: 800px;">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1499.0725324530904!2d98.54993435447957!3d3.536311515072958!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30312618b55c28c9%3A0xa030ca65920dfec1!2sKantor%20Kepala%20Desa%20Telaga%20Sari!5e0!3m2!1sid!2sid!4v1751038882321!5m2!1sid!2sid"
            width="600" height="450" style="border:0;" allowfullscreen loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </div>

      {{-- Luas Wilayah --}}
      <div id="dusun" class="text-center mb-5">
          <p class="fw-semibold fs-4 mb-3">
              <i class="bi bi-aspect-ratio me-2"></i> Luas Wilayah
          </p>
          <h6 class="mb-4">Total Luas Wilayah: <strong>315.4 Ha</strong></h6>

          @php
              $batas = [
                  ['label' => 'Dusun 5', 'dusun' => '48 Ha', 'color' => 'bg-warning'],
                  ['label' => 'Dusun 1', 'dusun' => '55 Ha', 'color' => 'bg-primary text-white'],
                  ['label' => 'Dusun 2', 'dusun' => '57.4 Ha', 'color' => 'bg-success text-white'],
                  ['label' => 'Dusun 6', 'dusun' => '51 Ha', 'color' => 'bg-danger text-white'],
                  ['label' => 'Dusun 3', 'dusun' => '54 Ha', 'color' => 'bg-info text-dark'],
                  ['label' => 'Dusun 4', 'dusun' => '50 Ha', 'color' => 'bg-secondary text-white'],
              ];
          @endphp

          {{-- Baris pertama: Dusun 5 --}}
          <div class="row justify-content-center mb-3">
              <div class="col-12 col-md-8 col-lg-6">
                  <div class="p-3 text-center shadow rounded {{ $batas[0]['color'] }} h-100">
                      <h5>{{ $batas[0]['label'] }}</h5>
                      <i class="bi bi-bullseye fs-3"></i>
                      <p class="mb-0">{{ $batas[0]['dusun'] }}</p>
                  </div>
              </div>
          </div>

          {{-- Baris kedua: Dusun lainnya --}}
          <div class="row justify-content-center g-3">
              @foreach (array_slice($batas, 1) as $item)
                  <div class="col-6 col-md-4 col-lg-2">
                      <div class="p-3 text-center shadow rounded {{ $item['color'] }} h-100">
                          <h5>{{ $item['label'] }}</h5>
                          <i class="bi bi-bullseye fs-3"></i>
                          <p class="mb-0">{{ $item['dusun'] }}</p>
                      </div>
                  </div>
              @endforeach
          </div>
      </div>

      {{-- Batas Wilayah --}}
      <div class="text-center mb-5">
        <p class="fw-semibold fs-4 mb-3"><i class="bi bi-arrows-fullscreen me-2"></i> Batas Wilayah</p>
        <div class="row justify-content-center g-3">
          @php
            $batas = [
                ['label' => 'Utara', 'desa' => 'Desa Sei Mencirim'],
                ['label' => 'Selatan', 'desa' => 'Desa Sukaraya'],
                ['label' => 'Barat', 'desa' => 'Desa Sukamaju'],
                ['label' => 'Timur', 'desa' => 'Desa Sawit Rejo'],
            ];
          @endphp
          @foreach ($batas as $item)
            <div class="col-6 col-md-4 col-lg-3">
              <div class="p-3 text-center shadow rounded bg-success text-white h-100">
                <h5>{{ $item['label'] }}</h5>
                <i class="bi bi-compass fs-3"></i>
                <p class="mb-0">{{ $item['desa'] }}</p>
              </div>
            </div>
          @endforeach
        </div>
      </div>

    </div>
  </div>
</section>

@endsection