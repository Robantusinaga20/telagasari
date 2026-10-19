@extends("layouts.admin")

@section("title", "Tambah Gambar")

@section("content")

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h4 class="text-center fw-bold mb-4 text-primary">Tambah Gambar</h4>

                    <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Tanggal --}}
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                        </div>

                        {{-- Gambar --}}
                        <div class="mb-4">
                            <label for="gambar" class="form-label fw-bold">Upload Gambar</label>
                            <!-- Container preview + tombol + -->
                            <div class="d-flex flex-wrap gap-3" id="preview-container">
                                <label for="gambar" id="upload-label"
                                    class="d-flex align-items-center justify-content-center border rounded-3 bg-light"
                                    style="width: 120px; height: 120px; cursor: pointer;">
                                    <span class="fs-1 text-primary">+</span>
                                </label>
                            </div>
                            <!-- Input file hidden -->
                            <input type="file" id="gambar" name="gambar[]" multiple class="d-none" accept="image/*">
                        </div>

                        <script>
                            const inputFile = document.getElementById('gambar');
                            const previewContainer = document.getElementById('preview-container');
                            const uploadLabel = document.getElementById('upload-label');

                            let filesArray = [];

                            inputFile.addEventListener('change', function () {
                                Array.from(this.files).forEach(file => {
                                    filesArray.push(file);
                                });
                                updatePreview();
                            });

                            function updatePreview() {
                                // Hapus semua preview lama kecuali tombol +
                                previewContainer.querySelectorAll('.preview-image').forEach(el => el.remove());

                                filesArray.forEach((file, index) => {
                                    const reader = new FileReader();
                                    reader.onload = function (e) {
                                        const previewDiv = document.createElement('div');
                                        previewDiv.classList.add('position-relative', 'preview-image');
                                        previewDiv.style.width = '120px';
                                        previewDiv.style.height = '120px';

                                        previewDiv.innerHTML = `
                                            <img src="${e.target.result}" class="w-100 h-100 rounded-3" style="object-fit: cover;">
                                            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 rounded-circle remove-image">&times;</button>
                                        `;

                                        // Insert sebelum tombol +
                                        previewContainer.insertBefore(previewDiv, uploadLabel);

                                        // Hapus gambar jika klik X
                                        previewDiv.querySelector('.remove-image').addEventListener('click', () => {
                                            filesArray.splice(index, 1);
                                            updatePreview();
                                        });
                                    };
                                    reader.readAsDataURL(file);
                                });

                                // Update inputFile.files agar sinkron
                                const dt = new DataTransfer();
                                filesArray.forEach(file => dt.items.add(file));
                                inputFile.files = dt.files;
                            }
                        </script>

                        {{-- Kategori --}}
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori Gambar</label>
                            {{-- Dropdown kategori --}}
                            <select id="kategori-select" class="form-select mb-2" onchange="updateKategoriInput(this.value)">
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Posyandu">Posyandu</option>
                                <option value="Kegiatan Desa">Kegiatan Desa</option>
                                <option value="Peternakan Sapi">Peternakan Sapi</option>
                                <option value="Peternakan Kambing">Peternakan Kambing</option>
                                <option value="Peternakan Bebek">Peternakan Bebek</option>
                                <option value="Perkebunan Jagung">Perkebunan Jagung</option>
                                <option value="Perkebunan Jambu">Perkebunan Jambu</option>
                                <option value="custom">Lainnya (Ketik Sendiri)</option>
                            </select>

                            {{-- Input text jika pilih "Lainnya" --}}
                            <input type="text" name="kategori" id="kategori-input" class="form-control"
                                placeholder="Masukkan kategori sendiri"
                                style="display: none;" required>
                        </div>

                        <script>
                            function updateKategoriInput(value) {
                                const input = document.getElementById('kategori-input');

                                if (value === 'custom' || value === '') {
                                    input.style.display = 'block';
                                    input.value = '';
                                } else {
                                    input.style.display = 'none';
                                    input.value = value;
                                }
                            }
                        </script>

                        {{-- Keterangan --}}
                        <div class="mb-3">
                            <label for="ket" class="form-label">Keterangan Gambar</label>
                            <textarea name="ket" id="ket" rows="6" class="form-control" placeholder="Masukkan keterangan gambar" required></textarea>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a type="button" class="btn btn-danger" href="{{ url('/admin-galeri') }}">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection