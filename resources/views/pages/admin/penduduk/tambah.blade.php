@extends("layouts.admin")

@section("title", "Tambah Data")

@section("content")

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h4 class="text-center fw-bold mb-4 text-primary">Tambah Data</h4>

            <form action="{{ route('penduduk.store') }}" method="POST">
                @csrf

                {{-- dusun --}}
                <div class="mb-3">
                    <label for="dusun" class="form-label">Nama Dusun</label>
                    <input type="text" name="dusun" id="dusun" class="form-control">
                </div>

                {{-- jumlah penduduk --}}
                <div class="mb-3">
                    <label for="jlh_penduduk" class="form-label">Jumlah Penduduk</label>
                    <input type="number" name="jlh_penduduk" id="jlh_penduduk" class="form-control">
                </div>

                {{-- jumlah keluarga --}}
                <div class="mb-3">
                    <label for="jlh_keluarga" class="form-label">Jumlah Keluarga</label>
                    <input type="number" name="jlh_keluarga" id="jlh_keluarga" class="form-control">
                </div>

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