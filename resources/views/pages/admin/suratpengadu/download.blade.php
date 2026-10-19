@extends('layouts.admin')

@section('title', 'Unduh Pengaduan')

@section('content')
<div class="container py-5" data-aos="fade-up">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h5 class="mb-0">Unduh Pengaduan</h5>
                </div>
                <form action="{{ route('suratpengadu.downloadPDF') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        {{-- Periode --}}
                        <label for="periode" class="form-label">Pilih Bulan & Tahun</label>
                        <input type="month" name="periode" id="periode" class="form-control mb-3" required>
                        <small class="text-muted">
                        {{-- Checkbox untuk download gambar --}}
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" name="download_images" id="download_images" value="1">
                            <label class="form-check-label" for="download_images">
                                Sertakan unduhan gambar (ZIP)
                            </label>
                        </div>
                            Hanya surat berstatus <strong>Dikonfirmasi</strong> yang akan diunduh.
                        </small>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-download me-1"></i> Unduh
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <a href="{{ route('suratpengadu.index') }}" class="bi bi-arrow-left btn btn-secondary"> Kembali</a>
</div>
@endsection