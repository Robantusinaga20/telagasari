@extends('layouts.admin')

@section('title', 'Arsip Surat')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4">Arsip Pengaduan</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Pemohon</th>
                    <th>Perihal</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($arsipSurat as $index => $surat)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $surat->name }}</td>
                        <td>{{ $surat->perihal }}</td>
                        <td>{{ $surat->created_at->format('d M Y') }}</td>
                        <td class="d-flex justify-content-center gap-2">
                            <a href="{{ route('suratpengadu.show', $surat->id) }}" class="btn btn-primary btn-sm">Detail</a>
                            <form action="{{ route('suratpengadu.keluarkan', $surat->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-warning btn-sm" 
                                    onclick="return confirm('Keluarkan pengaduan ini dari arsip?')">
                                    Keluarkan
                                </button>
                            </form>
                            <form action="{{ route('suratpengadu.destroy', $surat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-muted">Belum ada pengaduan yang diarsipkan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <a href="{{ route('suratpengadu.index') }}" class="btn btn-primary">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Pengaduan
        </a>
    </div>
</div>
@endsection
