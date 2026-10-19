@extends("layouts.admin")

@section("title", "Dashboard - Kelola Informasi Posyandu")

@section("content")

<section class="bg-light py-5" data-aos="fade-up">
    <div class="container">
        <h2 class="text-center fw-bold text-primary">Posyandu</h2>
        <div class="d-flex justify-content-center mt-2 mb-4">
            <div style="width: 60px; height: 4px; background-color:rgb(163, 15, 15); border-radius: 2px;"></div>
        </div>

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ url('/tbh-posyandu') }}" class="btn btn-success btn-lg">
                <i class="bi bi-plus-lg me-1"></i> Tambah Data
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
                        <th>Nama Posyandu</th>
                        <th>Kategori Posyandu</th>
                        <th>Tanggal</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posyandus as $index => $posyandu)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $posyandu->name }}</td>
                            <td>{{ $posyandu->kategori }}</td>
                            <td>{{ $posyandu->tanggal }} /Bulannya</td>
                            <td>{{ $posyandu->alamat }}</td>
                            <td>
                                <a href="{{ route('posyandu.edit', $posyandu->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('posyandu.destroy', $posyandu->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Belum ada Data Posyandu.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>

@endsection