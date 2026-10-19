@extends("layouts.admin")

@section("title", "Dashboard - Kritik & Saran")

@section("content")

<section class="bg-light py-5" data-aos="fade-up">
    <div class="container">
        <h2 class="text-center fw-bold text-primary">Kritik & Saran</h2>
        <div class="d-flex justify-content-center mt-2 mb-4">
            <div style="width: 60px; height: 4px; background-color:rgb(163, 15, 15); border-radius: 2px;"></div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th>Nomor Formulir</th>
                        <th>Tgl Pengiriman</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kritsars as $index => $kritsar)
                        <tr>
                            <td>{{ $kritsar->id }}</td>
                            <td>{{ $kritsar->created_at->locale('id')->translatedFormat('j F Y') }}
                            <td>
                                <a href="{{ route('kritsar.show', $kritsar->id) }}" class="btn btn-primary btn-sm">Detail</a>
                                <form action="{{ route('kritsar.destroy', $kritsar->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Belum ada Kritik dan Saran yang masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>

@endsection