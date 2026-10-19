@extends("layouts.admin")

@section("title", "Edit Data Posyandu")

@section("content")

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h4 class="text-center fw-bold mb-4 text-primary">Edit Data Posyandu</h4>

                    {{-- Form Edit posyandu --}}
                    <form action="{{ route('posyandu.update', $posyandus->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Nama --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Posyandu</label>
                            <input type="text" name="name" id="name" class="form-control" 
                                value="{{ $posyandus->name }}" required>
                        </div>

                        {{-- Kategori --}}
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori Posyandu</label>
                            <select name="kategori" id="kategori" class="form-select" required>
                                <option value="" disabled>Pilih Kategori</option>
                                <option value="Balita" {{ $posyandus->kategori == 'Balita' ? 'selected' : '' }}>Balita</option>
                                <option value="Ibu hamil" {{ $posyandus->kategori == 'Ibu hamil' ? 'selected' : '' }}>Ibu Hamil</option>
                                <option value="Lansia" {{ $posyandus->kategori == 'Lansia' ? 'selected' : '' }}>Lansia</option>
                            </select>
                        </div>

                        {{-- Tanggal --}}
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <select name="tanggal" id="tanggal" class="form-select" required>
                                <option value="" disabled>Pilih Tanggal</option>
                                @for ($i = 1; $i <= 30; $i++)
                                    <option value="{{ $i }}" {{ $posyandus->tanggal == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        {{-- Alamat --}}
                        <div class="mb-3">
                            <label for="alamat" class="form-label">alamat</label>
                            <input type="text" name="alamat" id="alamat" class="form-control" 
                            value="{{ $posyandus->alamat }}" required>
                        </div>

                        {{-- Tombol Submit --}}
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a type="button" class="btn btn-danger" href="{{ url('/admin-posyandu') }}">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection