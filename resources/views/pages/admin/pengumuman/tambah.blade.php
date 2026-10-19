@extends("layouts.admin")

@section("title", "Tambah Pengumuman Desa")

@section("content")

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h4 class="text-center fw-bold mb-4 text-primary">Tambah Pengumuman</h4>

                    <form action="{{ route('pengumuman.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Tanggal --}}
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                        </div>

                        {{-- Kategori --}}
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select id="kategori-select" class="form-select mb-2" onchange="updateKategoriInput(this.value)">
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Informasi Umum">Informasi Umum</option>
                                <option value="Pemerintahan">Pemerintahan</option>
                                <option value="Bantuan">Bantuan</option>
                                <option value="Pembangunan">Pembangunan</option>
                                <option value="Kependudukan">Kependudukan</option>
                                <option value="custom">Lainnya (Ketik Sendiri)</option>
                            </select>

                            {{-- Input text jika pilih "Lainnya" --}}
                            <input type="text" id="kategori-input" class="form-control mt-2"
                                placeholder="Masukkan kategori sendiri" style="display:none;">

                            {{-- Hidden field yg dikirim ke server --}}
                            <input type="hidden" name="kategori" id="kategori-hidden" value="">
                        </div>

                        <script>
                            function updateKategoriInput(value) {
                                const input = document.getElementById('kategori-input');
                                const hidden = document.getElementById('kategori-hidden');

                                if (value === 'custom') {
                                    input.style.display = 'block';
                                    input.value = '';
                                    hidden.value = '';
                                    input.addEventListener('input', () => {
                                        hidden.value = input.value;
                                    });
                                } else {
                                    input.style.display = 'none';
                                    input.value = '';
                                    hidden.value = value;
                                }
                            }
                        </script>

                        {{-- Judul --}}
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Pengumuman</label>
                            <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan judul pengumuman" required>
                        </div>

                        {{-- Isi --}}
                        <div class="mb-3">
                            <label for="isi" class="form-label">Isi Pengumuman</label>
                            <textarea name="isi" id="isi" rows="6" class="form-control" placeholder="Masukkan isi pengumuman" required></textarea>
                        </div>

                        {{-- Tombol --}}
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a type="button" class="btn btn-danger" href="{{ url('/admin-pengumuman') }}">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection