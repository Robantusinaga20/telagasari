@extends("layouts.admin")

@section("title", "Dashboard - Ajuan Pengaduan")

@section("content")

<section class="bg-light py-5" data-aos="fade-up">
    <div class="container py-4">
    <h2 class="fw-bold text-primary mb-4">Daftar Pengaduan</h2>

    <!-- Tombol di kanan -->
    <div class="d-flex justify-content-end gap-2 mb-4">
        <a href="{{ route('suratpengadu.arsip') }}" class="btn btn-outline-secondary">
            <i class="bi bi-envelope-check me-1"></i> Gudang Arsip
        </a>
        <a href="{{ route('suratpengadu.downloadPage') }}" class="btn btn-outline-success">
            <i class="bi bi-file-earmark-arrow-down me-1"></i> Unduh Rekap
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
                    <th>Nama Pemohon</th>
                    <th>Perihal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($suratpengadus as $index => $suratpengadu)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            {{ $suratpengadu->name }}<br>
                            <small class="text-muted">Dikirim: {{ $suratpengadu->created_at->format('d M Y') }}</small>
                        </td>
                        <td>{{ $suratpengadu->perihal }}</td>
                        <td>
                            @if($suratpengadu->status === 'Dikonfirmasi')
                                <span class="badge bg-success">Dikonfirmasi</span>
                            @else
                                <span class="badge bg-warning text-dark">Diproses</span>
                            @endif
                        </td>
                        <td class="d-flex justify-content-center gap-2">
                            <a href="{{ route('suratpengadu.show', $suratpengadu->id) }}" class="btn btn-primary btn-sm">Detail</a>

                            @if($suratpengadu->status !== 'Dikonfirmasi')
                                <form action="{{ route('suratpengadu.check', $suratpengadu->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success btn-sm">Konfirmasi</button>
                                </form>
                            @endif

                            @if($suratpengadu->status === 'Dikonfirmasi')
                                <form action="{{ route('suratpengadu.arsipkan', $suratpengadu->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-secondary btn-sm">Arsipkan</button>
                                </form>
                            @endif

                            <form action="{{ route('suratpengadu.destroy', $suratpengadu->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada Surat yang diajukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection