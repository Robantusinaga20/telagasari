@extends("layouts.admin")

@section("title", "Edit Data Penduduk")

@section("content")

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h4 class="text-center fw-bold mb-4 text-primary">Edit Data Penduduk</h4>

                    {{-- Form Edit Data Penduduk --}}
                    <form action="{{ route('penduduk.update', $penduduks->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- dusun --}}
                        <div class="mb-3">
                            <label for="dusun" class="form-label">Nama Dusun</label>
                            <input type="text" name="dusun" id="dusun" class="form-control" 
                            value="{{ $penduduks->dusun }}" required>
                        </div>

                        {{-- jlh_ penduduk --}}
                        <div class="mb-3">
                            <label for="jlh_penduduk" class="form-label">Jumlah Penduduk</label>
                            <input type="text" name="jlh_penduduk" id="jlh_penduduk" class="form-control" 
                                value="{{ $penduduks->jlh_penduduk }}" required>
                        </div>

                        {{-- jlh_ keluarga --}}
                        <div class="mb-3">
                            <label for="jlh_keluarga" class="form-label">Jumlah Keluarga</label>
                            <input type="text" name="jlh_keluarga" id="jlh_keluarga" class="form-control" 
                                value="{{ $penduduks->jlh_keluarga }}" required>
                        </div>

                        {{-- Tombol Submit --}}
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a type="button" class="btn btn-danger" href="{{ url('/admin-penduduk') }}">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection