@extends('layouts.app')

@section('title', 'Konfirmasi Pengajuan Surat')

@section('content')
<div class="container py-5" data-aos="fade-up">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 text-center">
                <div class="card-body p-5">
                    <i class="bi bi-check-circle-fill text-success display-3 mb-3"></i>
                    <h2 class="fw-bold text-success mb-3">Surat Berhasil Diajukan</h2>
                    <p class="mb-4">
                        Terima kasih, <strong>{{ $suratpengantars->name }}</strong>.<br>
                        Pengajuan <strong>{{ $suratpengantars->jen_surat }}</strong> Anda telah diterima dan sedang diproses oleh admin.
                    </p>
                    <div class="border rounded p-3 mb-4 bg-light">
                        <p class="mb-1"><strong>Tanggal Pengajuan:</strong> {{ $suratpengantars->created_at->format('d M Y, H:i') }}</p>
                        <p class ="mb-1"><strong>No Surat Anda:</strong> {{ $suratpengantars->id }}</p>
                        <p class="mb-1">
                            <strong>Status saat ini:</strong>
                            <span class="badge {{ $suratpengantars->status === 'Dikonfirmasi' ? 'bg-success' : 'bg-warning' }}">
                                {{ $suratpengantars->status }}
                            </span>
                        </p>
                        <a class="bi bi-search text-secondary fst-italic text-decoration-none" href="{{ url('/masyarakat#Cari') }}"> Gunakan No Surat untuk melihat status surat pada kolom pencarian surat</a>
                        <p class="mb-1">Silahkan kunjungi Kantor Desa Telaga Sari dengan membawa berkas-berkas pelengkap!</p>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-center">
                        <a href="{{ route('surat.download', ['tipe' => 'suratpengantar', 'id' => $suratpengantars->id]) }}" class="btn btn-success"><i class="bi bi-download"></i> Unduh Pengajuan</a>
                        <a href="{{ url('/masyarakat#Cari') }}" class="btn btn-primary px-4">Selesai</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection