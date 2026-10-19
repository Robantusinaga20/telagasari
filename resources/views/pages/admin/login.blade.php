@extends("layouts.app")

@section("title", "Login - Admin")

@section("content")
{{-- Hero Section --}}
    <div class="hero position-relative text-center text-white d-flex align-items-center justify-content-center" 
         style="height: 75vh; background: url('{{ asset('img/bg.png') }}') center/cover no-repeat;">
        <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100" 
             style="background: rgba(0,0,0,0.5);"></div>
        <div class="hero-content position-relative">
            <div class="card shadow-lg rounded border-0">
            <div class="card-body">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" width="40" height="40" class="me-2">
                <h4 class="text-center text-primary fw-bold mb-0">Login Dashboard Admin</h4>
                <p class="mt-0 mb-4">Desa Telaga Sari - Kecamatan Sunggal</p>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login.proses') }}">
                    @csrf
                    <div class="mb-3">
                        <input placeholder="username" type="text" name="username" class="form-control" id="username" required>
                    </div>

                    <div class="mb-3">
                        <input placeholder="password" type="password" name="password" class="form-control" id="password" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
@endsection