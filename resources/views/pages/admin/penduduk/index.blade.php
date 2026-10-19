@extends("layouts.admin")

@section("title", "Dashboard - Kelola Data Penduduk")

@section("content")

<section class="bg-light py-5" data-aos="fade-up">
    <div class="container">
        <h2 class="text-center fw-bold text-primary">Kelola Data Penduduk</h2>
        <div class="d-flex justify-content-center mt-2 mb-4">
            <div style="width: 60px; height: 4px; background-color:rgb(163, 15, 15); border-radius: 2px;"></div>
        </div>

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ url('/tbh-penduduk') }}" class="btn btn-success btn-lg">
                <i class="bi bi-plus-lg me-1"></i> Tambah Data
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="mt-4">
            <h5>Total Penduduk: <strong>{{ number_format($totalPenduduk, 0, ',', '.') }} jiwa</strong></h5>
            <h5>Total Keluarga: <strong>{{ number_format($totalKeluarga, 0, ',', '.') }} keluarga</strong></h5>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Dusun</th>
                        <th>Jumlah Penduduk</th>
                        <th>Jumlah Keluarga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penduduks as $index => $penduduk)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $penduduk->dusun }}</td>
                            <td>{{ number_format($penduduk->jlh_penduduk, 0, ',', '.') }} jiwa</td>
                            <td>{{ number_format($penduduk->jlh_keluarga, 0, ',', '.') }} keluarga</td>
                            <td>
                                <a href="{{ route('penduduk.edit', $penduduk->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('penduduk.destroy', $penduduk->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Belum ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>

@endsection