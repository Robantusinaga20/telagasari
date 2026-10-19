@extends('layouts.app')

@section('title', 'Konfirmasi Pengaduan')

@section('content')
<div class="container py-5" data-aos="fade-up">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 text-center">
                <div class="card-body p-5">
                    <i class="bi bi-check-circle-fill text-success display-3 mb-3"></i>
                    <h2 class="fw-bold text-success mb-3">Pengaduan Berhasil Diajukan</h2>
                    <p class="mb-4">
                        Terima kasih, <strong>{{ $suratpengadus->name }}</strong>.<br>
                        Pengaduan Anda telah diterima dan sedang diproses oleh admin.
                    </p>
                    <div class="border rounded p-3 mb-4 bg-light">
                        <p class="mb-1"><strong>Tanggal Pengajuan:</strong> {{ $suratpengadus->created_at->format('d M Y, H:i') }}</p>
                        <p class ="mb-1"><strong>No Pengaduan Anda:</strong> {{ $suratpengadus->id }}</p>
                        <p class="mb-1">
                            <strong>Status saat ini:</strong>
                            <span class="badge {{ $suratpengadus->status === 'Dikonfirmasi' ? 'bg-success' : 'bg-warning' }}">
                                {{ $suratpengadus->status }}
                            </span>
                        </p>
                        <a class="bi bi-search text-secondary fst-italic text-decoration-none" href="{{ url('/masyarakat#Cari') }}"> Gunakan No Surat untuk melihat status surat pada kolom pencarian surat</a>
                    </div>
                    <a href="{{ url('/masyarakat#Cari') }}" class="btn btn-primary px-4">Selesai</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection