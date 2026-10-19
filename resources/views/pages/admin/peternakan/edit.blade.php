@extends("layouts.admin")

@section("title", "Edit Data Peternakan")

@section("content")

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h4 class="text-center fw-bold mb-4 text-primary">Edit Data Peternakan</h4>

                    {{-- Form Edit peternakan --}}
                    <form action="{{ route('peternakan.update', $peternakans->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- jen_ternak --}}
                        <div class="mb-3">
                            <label for="jen_ternak" class="form-label">Jenis Ternak</label>
                            <input type="text" name="jen_ternak" id="jen_ternak" class="form-control" 
                                value="{{ $peternakans->jen_ternak}}" required>
                        </div>

                        {{-- pop_ternak --}}
                        <div class="mb-3">
                            <label for="pop_ternak" class="form-label">Populasi Ternak</label>
                            <input type="text" name="pop_ternak" id="pop_ternak" class="form-control" 
                                value="{{ $peternakans->pop_ternak }}" required>
                        </div>

                        {{-- jlh_pemilik --}}
                        <div class="mb-3">
                            <label for="jlh_pemilik" class="form-label">Jumlah Pemilik</label>
                            <input type="text" name="jlh_pemilik" id="jlh_pemilik" class="form-control" 
                                value="{{ $peternakans->jlh_pemilik }}" required>
                        </div>

                        {{-- Gambar Lama --}}
                        @if($peternakans->gambar)
                            <div class="mb-3">
                                <label class="form-label">Gambar Lama:</label><br>
                                <img src="{{ asset('storage/' . $peternakans->gambar) }}" alt="Gambar Lama" width="150">
                            </div>
                        @endif

                        {{-- Gambar Baru --}}
                        <div class="mb-4">
                            <label for="gambar" class="form-label">Ganti Gambar</label>
                            <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
                        </div>

                        {{-- Tombol Submit --}}
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