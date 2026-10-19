@extends("layouts.admin")

@section("title", "Dashboard - Kelola Data Usia Penduduk")

@section("content")

<section class="bg-light py-5" data-aos="fade-up">
    <div class="container">
        <h2 class="text-center fw-bold text-primary">Kelola Data Usia Penduduk</h2>
        <div class="d-flex justify-content-center mt-2 mb-4">
            <div style="width: 60px; height: 4px; background-color:rgb(163, 15, 15); border-radius: 2px;"></div>
        </div>

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ url('/tbh-usia') }}" class="btn btn-success btn-lg">
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
                        <th>Rentang Usia</th>
                        <th>Jumlah Laki-laki</th>
                        <th>Jumlah Perempuan</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($usias as $index => $usia)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $usia->usia }}</td>
                            <td>{{ number_format($usia->jlh_lk, 0, ',', '.') }}</td>
                            <td>{{ number_format($usia->jlh_pr, 0, ',', '.') }}</td>
                            <td>{{ number_format($usia->jlh_lk + $usia->jlh_pr, 0, ',', '.') }}</td>                            <td>
                                <a href="{{ route('usia.edit', $usia->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('usia.destroy', $usia->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
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