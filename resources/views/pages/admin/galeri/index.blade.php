@extends("layouts.admin")

@section("title", "Dashboard - Kelola Data Galeri")

@section("content")

<section class="bg-light py-5" data-aos="fade-up">
    <div class="container">
        <h2 class="text-center fw-bold text-primary">Kelola Data Galeri</h2>
        <div class="d-flex justify-content-center mt-2 mb-4">
            <div style="width: 60px; height: 4px; background-color:rgb(163, 15, 15); border-radius: 2px;"></div>
        </div>

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ url('/tbh-galeri') }}" class="btn btn-success btn-lg">
                <i class="bi bi-plus-lg me-1"></i> Tambah Gambar
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($galeris as $index => $galeri)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td style="width: 200px;">
                                <div id="carouselGaleri{{ $galeri->id }}" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach(json_decode($galeri->gambar) as $i => $img)
                                            <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                                                <img src="{{ asset('storage/' . $img) }}" 
                                                     class="d-block w-100 rounded border"
                                                     alt="Gambar {{ $i+1 }}"
                                                     style="height: 120px; object-fit: cover;">
                                            </div>
                                        @endforeach
                                    </div>
                                    @if(count(json_decode($galeri->gambar)) > 1)
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselGaleri{{ $galeri->id }}" data-bs-slide="prev" style="width: 30px;">
                                            <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: invert(1);"></span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselGaleri{{ $galeri->id }}" data-bs-slide="next" style="width: 30px;">
                                            <span class="carousel-control-next-icon" aria-hidden="true" style="filter: invert(1);"></span>
                                        </button>
                                    @endif
                                </div>
                            </td>

                            <td>{{ $galeri->tanggal->format('d M Y') }}</td>
                            <td>{{ $galeri->kategori }}</td>
                            <td>{{ $galeri->ket }}</td>
                            <td>
                                <a href="{{ route('galeri.edit', $galeri->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('galeri.destroy', $galeri->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Belum ada data.</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
