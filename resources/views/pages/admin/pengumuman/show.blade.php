@extends("layouts.app")

@section("title", $pengumuman->judul)

@section("content")
<section class="py-5 container" data-aos="fade-up">
    <h2 class="text-primary fw-bold mb-3">{{ $pengumuman->judul }}</h2>
    <p class="text-muted">{{ $pengumuman->kategori }}</p>
    <p class="text-muted">{{ \Carbon\Carbon::parse($pengumuman->created_at)->translatedFormat('d F Y') }}</p>

    <div class="text-justify">
        {!! nl2br(e($pengumuman->isi)) !!}
    </div>

    <a href="{{ url('/pengumuman') }}" class="btn btn-outline-primary mt-4">← Kembali</a>
</section>
@endsection