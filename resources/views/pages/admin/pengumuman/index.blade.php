@extends("layouts.admin")

@section("title", "Dashboard - Pengumuman Desa")

@section("content")

<section class="bg-light py-5" data-aos="fade-up">
    <div class="container">
        <h2 class="text-center fw-bold text-primary">Pengumuman Desa</h2>
        <div class="d-flex justify-content-center mt-2 mb-4">
            <div style="width: 60px; height: 4px; background-color:rgb(163, 15, 15); border-radius: 2px;"></div>
        </div>

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ url('/tbh-pengumuman') }}" class="btn btn-success btn-lg">
                <i class="bi bi-plus-lg me-1"></i> Tambah Pengumuman
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th style="width: 200px;">Judul</th>
                        <th style="width: 150px;">Kategori</th>
                        <th style="width: 300px;">Isi</th>
                        <th style="width: 120px;">Tanggal</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengumumans as $index => $pengumuman)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="text-wrap">{{ $pengumuman->judul }}</td>
                            <td>{{ $pengumuman->kategori }}</td>
                            <td class="text-wrap">
                                {{ Str::limit(strip_tags($pengumuman->isi), 50, '...') }}
                            </td>
                            <td>{{ \Carbon\Carbon::parse($pengumuman->tanggal)->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('pengumuman.edit', $pengumuman->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('pengumuman.destroy', $pengumuman->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Belum ada pengumuman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>

@endsection