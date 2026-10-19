@extends("layouts.app")

@section("title", "Layanan Masyarakat")

@section("content")

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h4 class="text-center fw-bold mb-4 text-primary">Pengaduan</h4>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('suratpengadu.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- perihal --}}
                        <div class="mb-3">
                            <label for="perihal" class="form-label">Perihal</label>
                            <input type="text" name="perihal" id="perihal" class="form-control" placeholder="Masukkan Perihal" required>
                        </div>

                        {{-- name --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Pengadu</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan Nama Lengkap" required>
                        </div>

                        {{-- nohp --}}
                        <div class="mb-3">
                            <label for="nohp" class="form-label">No HP/WhatsApp</label>
                            <div class="input-group">
                                <span class="input-group-text">+62</span>
                                <input type="text" name="nohp" id="nohp" class="form-control" placeholder="81234567890" required>
                            </div>
                        </div>
                        
                        {{-- alamat --}}
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat Pengadu</label>
                            <textarea name="alamat" id="alamat" rows="6" class="form-control" placeholder="Masukkan Alamat" required></textarea>
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

                        {{-- lokasi --}}
                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <textarea name="lokasi" id="lokasi" rows="6" class="form-control" placeholder="Masukkan lokasi" required></textarea>
                        </div>

                        {{-- deskripsi --}}
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="6" class="form-control" placeholder="Masukkan deskripsi tambahan dan detail tentang pengaduan anda disini.." required></textarea>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                            <a type="button" class="btn btn-danger" href="{{ url('/masyarakat#Cari') }}">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection