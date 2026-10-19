@extends("layouts.admin")

@section("title", "Edit Agenda Desa")

@section("content")

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h4 class="text-center fw-bold mb-4 text-primary">Edit Agenda</h4>

                    {{-- Form Edit Artikel --}}
                    <form action="{{ route('agenda.update', $agendas->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Tanggal --}}
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" 
                                value="{{ $agendas->tanggal->format('Y-m-d') }}" required>
                        </div>

                        {{-- Judul --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Kegiatan</label>
                            <input type="text" name="name" id="name" class="form-control" 
                                value="{{ $agendas->name }}" required>
                        </div>

                        {{-- Gambar Lama --}}
                        @if($agendas->gambar)
                            <div class="mb-3">
                                <label class="form-label">Gambar Lama:</label><br>
                                <img src="{{ asset('storage/' . $agendas->gambar) }}" alt="Gambar Lama" width="150">
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
                            <a type="button" class="btn btn-danger" href="{{ url('/admin-agenda') }}">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection