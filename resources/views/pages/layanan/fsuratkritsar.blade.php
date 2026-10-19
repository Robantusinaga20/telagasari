@extends("layouts.app")

@section("title", "Layanan Masyarakat")

@section("content")

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="d-grid d-md-end"></div>
                <a type="button" class="bi bi-arrow-left btn btn-secondary" href="{{ url('/masyarakat#Cari') }}"> Kembali</a>
            </div>
            <div class="card shadow border-0">
                <div class="card-body">
                    <h4 class="text-center fw-bold mb-4 text-primary">Formulir Kritik & Saran</h4>
                    <p class="text-center">Mari berikan Kritik & Saran yang membangun demi meningkatkan pelayanan dan perkembangan <br> Desa Telaga Sari - Kecamatan Sunggal Kabupaten Deli Serdang</p>

                    @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('kritsar.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- kritik --}}
                        <div class="mb-3">
                            <label for="kritik" class="form-label">Kritik</label>
                            <textarea name="kritik" id="kritik" rows="6" class="form-control" placeholder="Masukkan Kritik" required></textarea>
                        </div>

                        {{-- name --}}
                        <div class="mb-3">
                            <label for="sar" class="form-label">Saran</label>
                            <textarea name="saran" id="saran" rows="6" class="form-control" placeholder="Masukkan Saran" required></textarea>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection