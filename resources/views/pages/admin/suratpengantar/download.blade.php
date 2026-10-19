@extends('layouts.admin')

@section('title', 'Unduh Ajuan Surat Pengantar')

@section('content')
<div class="container py-5" data-aos="fade-up">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h5 class="mb-0">Unduh Pengajuan Surat Pengantar</h5>
                </div>
                <form action="{{ route('suratpengantar.downloadPDF') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        {{-- Jenis Surat --}}
                        <label for="jen_surat" class="form-label">Pilih Jenis Surat</label>
                        <select name="jen_surat" id="jen_surat" class="form-select mb-3" required>
                            <option value="" disabled selected>-- Pilih Jenis Surat --</option>
                            @foreach($jenisSurat as $jenis)
                                <option value="{{ $jenis }}">{{ $jenis }}</option>
                            @endforeach
                        </select>
                        {{-- Periode --}}
                        <label for="periode" class="form-label">Pilih Bulan & Tahun</label>
                        <input type="month" name="periode" id="periode" class="form-control mb-3" required>
                        <small class="text-muted">
                            Hanya surat berstatus <strong>Dikonfirmasi</strong> yang akan diunduh.
                        </small>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-download me-1"></i> Unduh PDF
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <a href="{{ route('suratpengantar.index') }}" class="bi bi-arrow-left btn btn-secondary"> Kembali</a>
</div>
@endsection