@extends('layouts.admin')

@section('title', 'Detail Pengajuan Surat Keterangan')

@section('content')
<div class="container py-5" data-aos="fade-up">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Detail Pengajuan Surat Keterangan</h4>
                </div>
                <div class="card-body p-4">
                    <p><strong>Nama Pemohon:</strong> {{ $suratket->name }}</p>
                    <p><strong>Jenis Surat:</strong> {{ $suratket->jen_surat }}</p>
                    <p><strong>Perihal:</strong> {{ $suratket->perihal }}</p>
                    <p><strong>No HP / WhatsApp:</strong> {{ $suratket->nohp }}</p>
                    <p><strong>Email:</strong> {{ $suratket->email }}</p>
                    <p><strong>NIK:</strong> {{ $suratket->nik }}</p>
                    <p><strong>No KK:</strong> {{ $suratket->nokk }}</p>
                    <p><strong>Alamat:</strong> {{ $suratket->alamat }}</p>
                    {{-- Slider Gambar --}}
                    <p><strong>Gambar:</strong></p>
                        @php
                            $gambarArray = json_decode($suratket->gambar, true); // decode dari JSON
                        @endphp
                        @if(!empty($gambarArray))
                            <div id="gambarCarousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($gambarArray as $key => $gambar)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <img src="{{ asset('storage/'.$gambar) }}" class="d-block w-100 rounded" alt="Gambar {{ $key+1 }}">
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#gambarCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#gambarCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        @else
                            <p>-</p>
                        @endif
                    <p><strong>Keterangan Tambahan:</strong> {{ $suratket->ket ?? '-' }}</p>
                    <p><strong>Status:</strong>
                        @if($suratket->status == 'Diproses')
                            <span class="badge bg-warning">Diproses</span>
                        @else
                            <span class="badge bg-success">Dikonfirmasi</span>
                        @endif
                    </p>
                    <p><strong>Tanggal Diajukan:</strong> {{ $suratket->created_at->format('d M Y, H:i') }}</p>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ url('/suratket') }}" class="btn btn-secondary">Kembali</a>

                    {{-- Tombol "Tandai Dikonfirmasi" hanya muncul jika statusnya masih Diproses --}}
                    @if($suratket->status === 'Diproses')
                        <form action="{{ route('suratket.check', $suratket->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success">Tandai Dikonfirmasi</button>
                        </form>
                    @endif

                    <form action="{{ route('suratket.destroy', $suratket->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pengajuan ini?')">
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