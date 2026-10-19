@extends("layouts.admin")

@section("title", "Tambah Data")

@section("content")

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h4 class="text-center fw-bold mb-4 text-primary">Tambah Data</h4>

            <form action="{{ route('usia.store') }}" method="POST">
                @csrf

                {{-- usia --}}
                <div class="mb-3">
                    <label for="usia" class="form-label">Rentang Usia</label>
                    <select name="usia" id="usia" class="form-select" required>
                        <option value="" disabled selected>Pilih Usia</option>
                        <option value="0-5 thn">0-5 thn</option>
                        <option value="6-12 thn">6-12 thn</option>
                        <option value="13-20 thn">13-20 thn</option>
                        <option value="21-30 thn">21-30 thn</option>
                        <option value="31-49 thn">31-49 thn</option>
                        <option value="50-65 thn">50-65 thn</option>
                        <option value="66 thn keatas">66 thn keatas</option>
                    </select>
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
                    <a type="button" class="btn btn-danger" href="{{ url('/admin-usia') }}">Batal</a>
                </div>
            </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection