<footer class="bg-primary text-white pt-5 pb-4 mt-5 w-100">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">

            {{-- Logo & Info Desa --}}
            <div class="col text-center">
                <img src="{{ asset('img/logo.png') }}" alt="Logo Desa" width="100" class="mb-3">
                <h5 class="fw-bold mb-1">Desa Telaga Sari</h5>
                <p class="mb-1">Kecamatan Sunggal</p>
            </div>

            {{-- Jam Layanan --}}
            <div class="col">
                <h6 class="fw-bold mb-3">Waktu Pelayanan</h6>
                <ul class="list-unstyled">
                    <li class="mb-1"><i class="bi bi-calendar me-2"></i> Senin - Jumat</li>
                    <li class="mb-1"><i class="bi bi-clock me-2"></i> 08.00 - 16.00 WIB</li>
                    <li><i class="bi bi-info-circle me-2"></i> Pengajuan surat di kantor desa</li>
                </ul>
            </div>

            {{-- Kontak & Alamat --}}
            <div class="col">
                <h6 class="fw-bold mb-3">Kontak</h6>
                <ul class="list-unstyled">
                    <li class="mb-1">
                        <i class="bi bi-geo-alt me-2"></i>
                        <a href="https://maps.app.goo.gl/JJNGqjMpGT74qaHC9" target="_blank" class="text-decoration-none text-white"> Jl. Diski Glugur Rimbun No.180</a>
                    </li>
                    <li class="mb-1">
                        <i class="bi bi-telephone me-2"></i>
                        <a href="https://wa.me/62882015637023?text=Halo%20saya%20ingin%20bertanya%20tentang%20Desa%20Telaga%20Sari."
                           target="_blank" class="text-decoration-none text-white"> +62882-0156-37023</a>
                    </li>
                    <li>
                        <i class="bi bi-envelope-at me-2"></i>
                        <a href="mailto:desatelagasarisunggal@gmail.com" class="text-decoration-none text-white"> <small>desatelagasarisunggal@gmail.com</small></a>
                    </li>
                </ul>
            </div>

            {{-- Link Navigasi --}}
            <div class="col">
                <h6 class="fw-bold mb-3">Tautan</h6>
                <ul class="list-unstyled">
                    <li><a href="{{ url('/admin-artikel') }}" class="text-white text-decoration-none d-block mb-2">Kelola Artikel</a></li>
                    <li><a href="{{ url('/admin-penduduk') }}" class="text-white text-decoration-none d-block mb-2">Data Penduduk</a></li>
                    <li><a href="{{ url('/admin-user') }}" class="text-white text-decoration-none d-block mb-2">Data Akun</a></li>
                    <li><a href="{{ url('/program') }}" class="text-white text-decoration-none d-block mb-2">Tentang Program</a></li>
                </ul>
            </div>
        </div>

        {{-- Garis Pemisah --}}
        <hr class="border-light opacity-50 mt-4">

        {{-- Copyright --}}
        <div class="text-center small d-flex justify-content-center align-items-center flex-wrap">
            <p class="mb-0 me-1">
                &copy; {{ date('Y') }} Desa Telaga Sari - Kecamatan Sunggal |
            </p>
            <a href="{{ url('/program') }}" class="text-white text-decoration-none">
                Dikembangkan oleh Tim Mahasiswa STMIK Triguna Dharma Medan
            </a>
        </div>
    </div>
</footer>