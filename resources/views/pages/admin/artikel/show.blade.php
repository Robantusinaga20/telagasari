@extends("layouts.app")

@section("title", $artikel->judul)

@section("content")
<section class="py-5 container" data-aos="fade-up">
    <h2 class="text-primary fw-bold mb-3">{{ $artikel->judul }}</h2>
    <p class="text-muted">{{ \Carbon\Carbon::parse($artikel->created_at)->translatedFormat('d F Y') }}</p>

    @if ($artikel->gambar)
        <img src="{{ asset('storage/' . $artikel->gambar) }}" class="img-fluid mb-4" alt="Gambar Artikel">
    @endif

    <div class="text-justify">
        {!! nl2br(e($artikel->isi)) !!}
    </div>

    <a href="{{ url('/artikel') }}" class="btn btn-outline-primary mt-4">← Kembali</a>
</section>
@endsection