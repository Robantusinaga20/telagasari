@extends("layouts.admin")

@section("title", "Dashboard Admin")

@section("content")
{{-- Hero Section --}}
    <div class="hero position-relative text-center text-white d-flex align-items-center justify-content-center" 
         style="height: 80vh; background: url('{{ asset('img/bg.png') }}') center/cover no-repeat;">
        <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100" 
             style="background: rgba(0,0,0,0.5);"></div>
        <div class="hero-content position-relative">
            <p class="fs-4 mb-1">Selamat Datang {{ Auth::user()->name }}</p>
            <h1 class="display-4 fw-bold mt-0">Dashboard</h1>
            <p class="fs-4 mb-1">Desa Telaga Sari, Kecamatan Sunggal - Kabupaten Deli Serdang</p>
        </div>
    </div>


@endsection