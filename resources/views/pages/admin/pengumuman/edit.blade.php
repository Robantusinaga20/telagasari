@extends("layouts.admin")

@section("title", "Edit Pengumuman Desa")

@section("content")

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h4 class="text-center fw-bold mb-4 text-primary">Edit Pengumuman</h4>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('pengumuman.update', $pengumumans->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Tanggal --}}
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" 
                                value="{{ $pengumumans->tanggal->format('Y-m-d') }}" required>
                        </div>

                        {{-- Judul --}}
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Pengumuman</label>
                            <input type="text" name="judul" id="judul" class="form-control" 
                                value="{{ $pengumumans->judul }}" required>
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

                            {{-- Input text untuk custom --}}
                            <input type="text" id="kategori-input" class="form-control mt-2"
                                placeholder="Masukkan kategori sendiri" style="display:none;">

                            {{-- Hidden field untuk submit --}}
                            <input type="hidden" name="kategori" id="kategori-hidden" value="{{ old('kategori', $pengumumans->kategori ?? '') }}">
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', () => {
                                const oldValue = "{{ old('kategori', $pengumumans->kategori ?? '') }}";
                                const select = document.getElementById('kategori-select');
                                const input = document.getElementById('kategori-input');
                                const hidden = document.getElementById('kategori-hidden');

                                if (['Informasi Umum', 'Pemerintahan', 'Bantuan', 'Pembangunan', 'Kependudukan'].includes(oldValue)) {
                                    select.value = oldValue;
                                    input.style.display = 'none';
                                    hidden.value = oldValue;
                                } else {
                                    select.value = 'custom';
                                    input.style.display = 'block';
                                    input.value = oldValue;
                                    hidden.value = oldValue;
                                    input.addEventListener('input', () => {
                                        hidden.value = input.value;
                                    });
                                }
                            });

                            function updateKategoriInput(value) {
                                const input = document.getElementById('kategori-input');
                                const hidden = document.getElementById('kategori-hidden');

                                if (value === 'custom') {
                                    input.style.display = 'block';
                                    input.value = hidden.value || '';
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

                        {{-- Isi --}}
                        <div class="mb-3">
                            <label for="isi" class="form-label">Isi Pengumuman</label>
                            <textarea name="isi" id="isi" rows="6" class="form-control" required>{{ $pengumumans->isi }}</textarea>
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