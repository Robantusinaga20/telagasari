@extends("layouts.admin")

@section("title", "Tambah Data")

@section("content")

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h4 class="text-center fw-bold mb-4 text-primary">Tambah Data</h4>

            <form action="{{ route('pekerjaan.store') }}" method="POST">
                @csrf

                {{-- jen_kerja --}}
                <div class="mb-3">
                    <label for="jen_kerja" class="form-label">Jenis Pekerjaan</label>
                    <input type="text" name="jen_kerja" id="jen_kerja" class="form-control">
                </div>

                {{-- jumlah lk --}}
                <div class="mb-3">
                    <label for="jlh_lk" class="form-label">Jumlah Laki-laki</label>
                    <input type="number" name="jlh_lk" id="jlh_lk" class="form-control">
                </div>

                {{-- jumlah pr --}}
                <div class="mb-3">
                    <label for="jlh_pr" class="form-label">Jumlah Perempuan</label>
                    <input type="number" name="jlh_pr" id="jlh_pr" class="form-control">
                </div>
                

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a type="button" class="btn btn-danger" href="{{ url('/admin-pekerjaan') }}">Batal</a>
                </div>
            </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection