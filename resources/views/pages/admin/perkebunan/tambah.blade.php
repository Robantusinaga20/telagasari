@extends("layouts.admin")

@section("title", "Tambah Data perkebunan")

@section("content")

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h4 class="text-center fw-bold mb-4 text-primary">Tambah Data Perkebunan</h4>

                    <form action="{{ route('perkebunan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- jen_tanaman --}}
                        <div class="mb-3">
                            <label for="jen_tanaman" class="form-label">Jenis Tanaman</label>
                            <input type="text" name="jen_tanaman" id="jen_tanaman" class="form-control" required placeholder="Masukkan jenis tanaman" required>
                        </div>

                        {{-- luas --}}
                        <div class="mb-3">
                            <label for="luas" class="form-label">Luas</label>
                            <input type="text" name="luas" id="luas" class="form-control" placeholder="Masukkan Luas" required>
                        </div>

                         {{-- jlh_panen --}}
                        <div class="mb-3">
                            <label for="jlh_panen" class="form-label">Jumlah Panen</label>
                            <input type="text" name="jlh_panen" id="jlh_panen" class="form-control" placeholder="Masukkan jumlah panen" required>
                        </div>

                        {{-- Gambar --}}
                        <div class="mb-4">
                            <label for="gambar" class="form-label">Upload Gambar</label>
                            <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*" required>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a type="button" class="btn btn-danger" href="{{ url('/admin-perkebunan') }}">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection