@extends("layouts.admin")

@section("title", "Tambah Data Peternakan")

@section("content")

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h4 class="text-center fw-bold mb-4 text-primary">Tambah Data Peternakan</h4>

                    <form action="{{ route('peternakan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- jen_ternak --}}
                        <div class="mb-3">
                            <label for="jen_ternak" class="form-label">Jenis Ternak</label>
                            <input type="text" name="jen_ternak" id="jen_ternak" class="form-control" required placeholder="Masukkan jenis hewan ternak" required>
                        </div>

                        {{-- pop_ternak --}}
                        <div class="mb-3">
                            <label for="pop_ternak" class="form-label">Populasi</label>
                            <input type="text" name="pop_ternak" id="pop_ternak" class="form-control" placeholder="Masukkan populasi hewan ternak" required>
                        </div>

                        {{-- jlh_pemilik --}}
                        <div class="mb-3">
                            <label for="jlh_pemilik" class="form-label">Jumlah Pemilik</label>
                            <input type="text" name="jlh_pemilik" id="jlh_pemilik" class="form-control" placeholder="Masukkan jumlah pemilik" required>
                        </div>

                        {{-- Gambar --}}
                        <div class="mb-4">
                            <label for="gambar" class="form-label">Upload Gambar</label>
                            <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*" required>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a type="button" class="btn btn-danger" href="{{ url('/peternakan') }}">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection