@extends('layouts.admin')

@section('title', 'Detail Formulir Kritik & Saran')

@section('content')
<div class="container py-5" data-aos="fade-up">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Detail Kritik & Saran</h4>
                </div>
                <div class="card-body p-4">
                    <p><strong>No Formulir:</strong> {{ $kritsar->id }}</p>
                    <p><strong>Tanggal Pengiriman:</strong> {{ $kritsar->created_at->format('d M Y, H:i') }}</p>
                    <p><strong>Kritik:</strong></p>
                        <p>{{ $kritsar->kritik }}</p>
                    <p><strong>Saran:</strong></p>
                        <p>{{ $kritsar->saran }}</p>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ url('/kritsar') }}" class="btn btn-secondary">Kembali</a>
                    <form action="{{ route('kritsar.destroy', $kritsar->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection