@extends("layouts.admin")

@section("title", "Edit Data Usia")

@section("content")

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h4 class="text-center fw-bold mb-4 text-primary">Edit Data Usia</h4>

                    {{-- Form Edit Data usia --}}
                    <form action="{{ route('usia.update', $usias->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- usia --}}
                        <div class="mb-3">
                            <label for="usia" class="form-label">Rentang Usia</label>
                            <select name="usia" id="usia" class="form-select" required>
                                <option value="" disabled>Pilih Usia</option>
                                <option value="0-5 thn" {{ $usias->usia == '0-5 thn' ? 'selected' : '' }}>0-5 thn</option>
                                <option value="6-12 thn" {{ $usias->usia == '6-12 thn' ? 'selected' : '' }}>6-12 thn</option>
                                <option value="13-20 thn" {{ $usias->usia == '13-20 thn' ? 'selected' : '' }}>13-20 thn</option>
                                <option value="21-30 thn" {{ $usias->usia == '21-30 thn' ? 'selected' : '' }}>21-30 thn</option>
                                <option value="31-49 thn" {{ $usias->usia == '31-49 thn' ? 'selected' : '' }}>31-49 thn</option>
                                <option value="50=65 thn" {{ $usias->usia == '50=65 thn' ? 'selected' : '' }}>50=65 thn</option>
                                <option value="66 thn keatas" {{ $usias->usia == '66 thn keatas' ? 'selected' : '' }}>66 thn keatas</option>
                            </select>
                        </div>

                        {{-- jlh_ lk --}}
                        <div class="mb-3">
                            <label for="jlh_lk" class="form-label">Jumlah laki-laki</label>
                            <input type="text" name="jlh_lk" id="jlh_lk" class="form-control" 
                                value="{{ $usias->jlh_lk }}" required>
                        </div>

                        {{-- jlh_ pr --}}
                        <div class="mb-3">
                            <label for="jlh_pr" class="form-label">Jumlah Perempuan</label>
                            <input type="text" name="jlh_pr" id="jlh_pr" class="form-control" 
                                value="{{ $usias->jlh_pr }}" required>
                        </div>

                        {{-- Tombol Submit --}}
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a type="button" class="btn btn-danger" href="{{ url('/admin-usia') }}">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection