@extends("layouts.admin")

@section("title", "Tambah Agenda Desa")

@section("content")

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h4 class="text-center fw-bold mb-4 text-primary">Tambah Agenda</h4>

                    <form action="{{ route('agenda.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Tanggal --}}
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                        </div>

                        {{-- Judul --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Kegiatan</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama kegiatan" required>
                        </div>

                        {{-- Gambar --}}
                        <div class="mb-4">
                            <label for="gambar" class="form-label">Upload Gambar</label>
                            <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*" required>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a type="button" class="btn btn-danger" href="{{ url('/admin-agenda') }}">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection