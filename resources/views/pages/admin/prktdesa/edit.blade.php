@extends("layouts.admin")

@section("title", "Edit Perangkat Desa")

@section("content")

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h4 class="text-center fw-bold mb-4 text-primary">Edit Perangkat Desa</h4>

                    {{-- Form Edit prktdesa --}}
                    <form action="{{ route('prktdesa.update', $prktdesas->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Nama --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" id="name" class="form-control" 
                                value="{{ $prktdesas->name }}" required>
                        </div>

                        {{-- Jabatan --}}
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" name="jabatan" id="jabatan" class="form-control" 
                            value="{{ $prktdesas->jabatan }}" required>

                        </div>

                        {{-- Gambar Lama --}}
                        @if($prktdesas->gambar)
                            <div class="mb-3">
                                <label class="form-label">Gambar Lama:</label><br>
                                <img src="{{ asset('storage/' . $prktdesas->gambar) }}" alt="Gambar Lama" width="150">
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
                            <a type="button" class="btn btn-danger" href="{{ url('/admin-prktdesa') }}">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection