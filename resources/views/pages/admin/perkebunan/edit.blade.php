@extends("layouts.admin")

@section("title", "Edit Data Perkebunan")

@section("content")

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h4 class="text-center fw-bold mb-4 text-primary">Edit Data Perkebunan</h4>

                    {{-- Form Edit perkebunan --}}
                    <form action="{{ route('perkebunan.update', $perkebunans->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- jen_ternak --}}
                        <div class="mb-3">
                            <label for="jen_tanaman" class="form-label">Jenis tanaman</label>
                            <input type="text" name="jen_tanaman" id="jen_tanaman" class="form-control" 
                                value="{{ $perkebunans->jen_tanaman}}" required>
                        </div>

                        {{-- luas--}}
                        <div class="mb-3">
                            <label for="luas" class="form-label">Populasi Ternak</label>
                            <input type="text" name="luas" id="luas" class="form-control" 
                                value="{{ $perkebunans->luas }}" required>
                        </div>

                        {{-- jlh_panen --}}
                        <div class="mb-3">
                            <label for="jlh_panen" class="form-label">Jumlah panen</label>
                            <input type="text" name="jlh_panen" id="jlh_panen" class="form-control" 
                                value="{{ $perkebunans->jlh_panen }}" required>
                        </div>

                        {{-- Gambar Lama --}}
                        @if($perkebunans->gambar)
                            <div class="mb-3">
                                <label class="form-label">Gambar Lama:</label><br>
                                <img src="{{ asset('storage/' . $perkebunans->gambar) }}" alt="Gambar Lama" width="150">
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
                            <a type="button" class="btn btn-danger" href="{{ url('/admin-perkebunan') }}">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection