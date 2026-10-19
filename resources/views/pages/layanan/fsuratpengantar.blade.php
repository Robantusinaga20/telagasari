@extends("layouts.app")

@section("title", "Layanan Masyarakat")

@section("content")

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h4 class="text-center fw-bold mb-4 text-primary">Pengajuan Surat Pengantar KK & KTP</h4>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('suratpengantar.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                    {{-- pilih surat --}}
                    <div class="mb-3">
                        <label for="jen_surat" class="form-label">Pilih Jenis Surat Pengantar</label>
                        <select name="jen_surat" id="jen_surat" class="form-select" required>
                            <option value="" disabled selected>Pilih Surat</option>
                            <option value="Surat Pengantar KK">Surat Pengantar KK</option>
                            <option value="Surat Pengantar KTP">Surat Pengantar KTP</option>
                        </select>
                    </div>

                        {{-- perihal --}}
                        <div class="mb-3">
                            <label for="perihal" class="form-label">Perihal</label>
                            <input type="text" name="perihal" id="perihal" class="form-control" placeholder="Masukkan Perihal" required>
                        </div>

                       {{-- nohp --}}
                        <div class="mb-3">
                            <label for="nohp" class="form-label">No HP/WhatsApp</label>
                            <div class="input-group">
                                <span class="input-group-text">+62</span>
                                <input type="text" name="nohp" id="nohp" class="form-control" placeholder="81234567890" required>
                            </div>
                        </div>

                        {{-- email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Masukkan Email" required>
                        </div>

                        {{-- name --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan Nama Lengkap" required>
                        </div>

                        {{-- tplahir --}}
                        <div class="mb-3">
                            <label for="tplahir" class="form-label">Tempat Lahir</label>
                            <input type="text" name="tplahir" id="tplahir" class="form-control" placeholder="Masukkan Tempat Lahir" required>
                        </div>

                        {{-- Tanggal Lahir --}}
                        <div class="mb-3">
                            <label for="tglahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tglahir" id="tglahir" class="form-control" required>
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div class="mb-3">
                            <label for="jen_kel" class="form-label">Jenis Kelamin</label>
                            <select name="jen_kel" id="jen_kel" class="form-select" required>
                                <option value="" disabled selected>---</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        {{-- Agama --}}
                        <div class="mb-3">
                            <label for="agama" class="form-label">Agama</label>
                            <select name="agama" id="agama" class="form-select" required>
                                <option value="" disabled selected>---</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>

                        {{-- Status --}}
                        <div class="mb-3">
                            <label for="stat" class="form-label">Status</label>
                            <select name="stat" id="stat" class="form-select" required>
                                <option value="" disabled selected>---</option>
                                <option value="Belum Menikah">Belum Menikah</option>
                                <option value="Menikah">Menikah</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>

                        {{-- pekerjaan --}}
                        <div class="mb-3">
                            <label for="pkerja" class="form-label">Pekerjaan</label>
                            <input type="text" name="pkerja" id="pkerja" class="form-control" placeholder="Masukkan Pekerjaan" required>
                        </div>
                        
                        {{-- alamat --}}
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" id="alamat" rows="6" class="form-control" placeholder="Masukkan Alamat" required></textarea>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                            <a type="button" class="btn btn-danger" href="{{ url('/masyarakat#Cari') }}">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection