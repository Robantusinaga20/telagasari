@extends("layouts.admin")

@section("title", "Edit Data Pekerjaan")

@section("content")

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h4 class="text-center fw-bold mb-4 text-primary">Edit Data Pekerjaan</h4>

                    {{-- Form Edit Data Pekerjaan --}}
                    <form action="{{ route('pekerjaan.update', $pekerjaans->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- jen_kerja --}}
                        <div class="mb-3">
                            <label for="jen_kerja" class="form-label">Jenis Pekerjaan</label>
                            <input type="text" name="jen_kerja" id="jen_kerja" class="form-control" 
                            value="{{ $pekerjaans->jen_kerja }}" required>
                        </div>

                        {{-- jlh_ lk --}}
                        <div class="mb-3">
                            <label for="jlh_lk" class="form-label">Jumlah laki-laki</label>
                            <input type="text" name="jlh_lk" id="jlh_lk" class="form-control" 
                                value="{{ $pekerjaans->jlh_lk }}" required>
                        </div>

                        {{-- jlh_ pr --}}
                        <div class="mb-3">
                            <label for="jlh_pr" class="form-label">Jumlah Perempuan</label>
                            <input type="text" name="jlh_pr" id="jlh_pr" class="form-control" 
                                value="{{ $pekerjaans->jlh_pr }}" required>
                        </div>

                        {{-- Tombol Submit --}}
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