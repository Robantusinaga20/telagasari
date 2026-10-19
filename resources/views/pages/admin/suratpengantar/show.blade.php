@extends('layouts.admin')

@section('title', 'Detail Surat Pengantar')

@section('content')
<div class="container py-5" data-aos="fade-up">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Detail Pengajuan Surat Pengantar</h4>
                </div>
                <div class="card-body p-4">
                    <p><strong>Nama Pemohon:</strong> {{ $suratpengantar->name }}</p>
                    <p><strong>Jenis Kelamin:</strong> {{ $suratpengantar->jen_kel }}</p>
                    <p><strong>Tempat Lahir:</strong> {{ $suratpengantar->tplahir }}</p>
                    <p><strong>Tanggal Lahir:</strong> 
                        {{ \Carbon\Carbon::parse($suratpengantar->tglahir)->format('d/m/Y') }}
                    </p>
                    <p><strong>Agama:</strong> {{ $suratpengantar->agama }}</p>
                    <p><strong>Status Perkawinan:</strong> {{ $suratpengantar->stat }}</p>
                    <p><strong>Pekerjaan:</strong> {{ $suratpengantar->pkerja }}</p>
                    <p><strong>Alamat:</strong> {{ $suratpengantar->alamat }}</p>
                    <hr>
                    <p><strong>Jenis Surat:</strong> {{ $suratpengantar->jen_surat }}</p>
                    <p><strong>Perihal:</strong> {{ $suratpengantar->perihal }}</p>
                    <p><strong>No HP / WhatsApp:</strong> {{ $suratpengantar->nohp }}</p>
                    <p><strong>Email:</strong> {{ $suratpengantar->email }}</p>
                    <p><strong>Keterangan Tambahan:</strong> {{ $suratpengantar->ket ?? '-' }}</p>
                    <p><strong>Status:</strong>
                        @if($suratpengantar->status == 'Diproses')
                            <span class="badge bg-warning">Diproses</span>
                        @else
                            <span class="badge bg-success">Dikonfirmasi</span>
                        @endif
                    </p>
                    <p><strong>Tanggal Diajukan:</strong> 
                        {{ $suratpengantar->created_at->format('d/m/Y H:i') }}
                    </p>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ url('/suratpengantar') }}" class="btn btn-secondary">Kembali</a>

                    {{-- Tombol "Tandai Dikonfirmasi" hanya muncul jika statusnya masih Diproses --}}
                    @if($suratpengantar->status === 'Diproses')
                        <form action="{{ route('suratpengantar.check', $suratpengantar->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success">Tandai Dikonfirmasi</button>
                        </form>
                    @endif

                    <form action="{{ route('suratpengantar.destroy', $suratpengantar->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pengajuan ini?')">
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