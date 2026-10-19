@extends("layouts.app")

@section("title", "Data Penduduk Desa")

@section("content")
    {{-- Hero Section --}}
    <div class="hero position-relative text-center text-white d-flex align-items-center justify-content-center" 
         style="height: 70vh; background: url('{{ asset('img/bg.png') }}') center/cover no-repeat;">
        <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100" 
             style="background: rgba(0,0,0,0.55);"></div>
        <div class="hero-content position-relative" data-aos="zoom-in">
            <h1 class="display-4 fw-bold mt-0">Data Penduduk</h1>
            <p class="fs-4 mb-1">Desa Telaga Sari, Kecamatan Sunggal - Kabupaten Deli Serdang</p>
        </div>
    </div>

    <hr class="my-4">

    {{-- Jumlah Penduduk --}}
    <section id="total" class="row justify-content-center align-items-center mb-5">
        <div class="col-lg-8" data-aos="fade-up">
            <div class="card border-0 shadow-lg rounded-4 p-4 text-center bg-light">
                <h3 class="text-success fw-bold mb-4" style="font-family: Georgia, serif;">
                    👨‍👩‍👧‍👦 Jumlah Penduduk
                </h3>
                <div class="d-flex flex-column gap-2">
                    <h5>Total Penduduk: 
                        <strong class="text-dark">{{ number_format($totalPenduduk, 0, ',', '.') }} jiwa</strong>
                    </h5>
                    <h5>Total Keluarga: 
                        <strong class="text-dark">{{ number_format($totalKeluarga, 0, ',', '.') }} keluarga</strong>
                    </h5>
                </div>
            </div>
        </div>
    </section>
    
    {{-- Diagram Dusun --}}
    <div class="row">
        <div class="col-md-6 mb-4" data-aos="fade-right">
            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-body">
                    <h5 class="text-center mb-3 text-primary">
                        🏘️ Jumlah Penduduk per Dusun
                    </h5>
                    <canvas id="pendudukChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4" data-aos="fade-left">
            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-body">
                    <h5 class="text-center mb-3 text-primary">
                        🏠 Jumlah Keluarga per Dusun
                    </h5>
                    <canvas id="keluargaChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Diagram Pekerjaan --}}
    <div class="row justify-content-center mt-4 mb-5">
        <div class="col-md-10" data-aos="zoom-in">
            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-body">
                    <h5 class="text-center text-primary mb-3">
                        💼 Jumlah Penduduk Berdasarkan Jenis Pekerjaan
                    </h5>
                    <canvas id="pekerjaanChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Diagram Usia --}}
    <div class="row justify-content-center mt-4 mb-5">
        <div class="col-md-10" data-aos="zoom-in">
            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-body">
                    <h5 class="text-center text-primary mb-3">
                        📈 Jumlah Penduduk Berdasarkan Rentang Usia
                    </h5>
                    <canvas id="usiaChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js"></script>

<script>
    // --- Chart Penduduk & Keluarga per Dusun ---
    const labelsDusun = {!! json_encode($labels) !!};
    const dataPenduduk = {!! json_encode($jumlahPenduduk) !!};
    const dataKeluarga = {!! json_encode($jumlahKeluarga) !!};

    const pieOptions = {
        plugins: {
            datalabels: {
                color: '#fff',
                formatter: (value, context) => {
                    let sum = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                    let percentage = (value / sum * 100).toFixed(1) + '%';
                    return value + ' (' + percentage + ')';
                },
                font: { weight: 'bold', size: 13 }
            },
            legend: { position: 'bottom' }
        }
    };

    new Chart(document.getElementById('pendudukChart'), {
        type: 'pie',
        data: {
            labels: labelsDusun,
            datasets: [{
                label: 'Jumlah Penduduk',
                data: dataPenduduk,
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796'],
            }]
        },
        options: pieOptions,
        plugins: [ChartDataLabels]
    });

    new Chart(document.getElementById('keluargaChart'), {
        type: 'pie',
        data: {
            labels: labelsDusun,
            datasets: [{
                label: 'Jumlah Keluarga',
                data: dataKeluarga,
                backgroundColor: ['#f6c23e', '#e74a3b', '#36b9cc', '#4e73df', '#1cc88a', '#858796'],
            }]
        },
        options: pieOptions,
        plugins: [ChartDataLabels]
    });

    // --- Chart Pekerjaan ---
    const labelsPekerjaan = {!! json_encode($labelsPekerjaan) !!};
    const dataKerjaLk = {!! json_encode($jumlahKerjaLk) !!};
    const dataKerjaPr = {!! json_encode($jumlahKerjaPr) !!};

    new Chart(document.getElementById('pekerjaanChart'), {
        type: 'bar',
        data: {
            labels: labelsPekerjaan,
            datasets: [
                { label: 'Laki-laki', data: dataKerjaLk, backgroundColor: '#4e73df' },
                { label: 'Perempuan', data: dataKerjaPr, backgroundColor: '#e74a3b' }
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } },
            scales: {
                y: { beginAtZero: true, title: { display: true, text: 'Jumlah Penduduk' } },
                x: { title: { display: true, text: 'Jenis Pekerjaan' } }
            }
        }
    });

    // --- Chart Usia ---
    const labelsUsia = {!! json_encode($labelsUsia) !!};
    const dataUsiaLk = {!! json_encode($jumlahUsiaLk) !!};
    const dataUsiaPr = {!! json_encode($jumlahUsiaPr) !!};

    new Chart(document.getElementById('usiaChart'), {
        type: 'bar',
        data: {
            labels: labelsUsia,
            datasets: [
                { label: 'Laki-laki', data: dataUsiaLk, backgroundColor: '#4e73df' },
                { label: 'Perempuan', data: dataUsiaPr, backgroundColor: '#e74a3b' }
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } },
            scales: {
                y: { beginAtZero: true, title: { display: true, text: 'Jumlah Penduduk' } },
                x: { title: { display: true, text: 'Rentang Usia' } }
            }
        }
    });
</script>
@endpush