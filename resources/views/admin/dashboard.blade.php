@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Petugas</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">60</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total Hadir</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">18</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Persentase Kehadiran
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h3 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%"
                                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <!-- Content Row -->

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-11">
                <div class="card shadow mb-1">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Grafik Presensi Petugas</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area" style="display: flex; justify-content: center">
                            <canvas id="chartPresensi"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Content Column -->
            <div class="col-xl-12 col-lg-11">

                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">List Presensi Petugas</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>Shift</th>
                                        <th>Waktu</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>2024-06-20</td>
                                        <td>Ahmad Yusuf</td>
                                        <td>1234567890</td>
                                        <td>Pagi</td>
                                        <td>07:00 - 15:00</td>
                                        <td>Hadir</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>2024-06-20</td>
                                        <td>Siti Rahma</td>
                                        <td>2345678901</td>
                                        <td>Siang</td>
                                        <td>15:00 - 23:00</td>
                                        <td>Hadir</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>2024-06-21</td>
                                        <td>Wawan Kurniawan</td>
                                        <td>3456789012</td>
                                        <td>Malam</td>
                                        <td>23:00 - 07:00</td>
                                        <td>Tidak Hadir</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>2024-06-21</td>
                                        <td>Dewi Sartika</td>
                                        <td>4567890123</td>
                                        <td>Pagi</td>
                                        <td>07:00 - 15:00</td>
                                        <td>Hadir</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>2024-06-22</td>
                                        <td>Andi Saputra</td>
                                        <td>5678901234</td>
                                        <td>Siang</td>
                                        <td>15:00 - 23:00</td>
                                        <td>Hadir</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>2024-06-22</td>
                                        <td>Nina Puspita</td>
                                        <td>6789012345</td>
                                        <td>Malam</td>
                                        <td>23:00 - 07:00</td>
                                        <td>Hadir</td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>2024-06-23</td>
                                        <td>Budi Santoso</td>
                                        <td>7890123456</td>
                                        <td>Pagi</td>
                                        <td>07:00 - 15:00</td>
                                        <td>Tidak Hadir</td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>2024-06-23</td>
                                        <td>Maya Sari</td>
                                        <td>8901234567</td>
                                        <td>Siang</td>
                                        <td>15:00 - 23:00</td>
                                        <td>Hadir</td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>2024-06-24</td>
                                        <td>Joko Prasetyo</td>
                                        <td>9012345678</td>
                                        <td>Malam</td>
                                        <td>23:00 - 07:00</td>
                                        <td>Hadir</td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>2024-06-24</td>
                                        <td>Lina Rahmawati</td>
                                        <td>0123456789</td>
                                        <td>Pagi</td>
                                        <td>07:00 - 15:00</td>
                                        <td>Hadir</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
    <script>
        const dataKehadiran = [10, 15, 8, 12, 20, 5]; // Contoh data

        // Membuat chart
        const ctx = document.getElementById('chartPresensi').getContext('2d');
        const kehadiranChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
                datasets: [{
                    data: dataKehadiran,
                    borderColor: "rgba(78, 115, 223, 1)",
                    backgroundColor: "rgba(78, 115, 223, 0.2)",
                    fill: false,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 5,
                    pointHoverRadius: 7,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    datalabels: {
                        anchor: 'end',
                        align: 'bottom',
                        offset: 10,
                        color: '#1cc88a',
                        font: {
                            weight: 'bold'
                        },
                        formatter: (value, ctx) => {
                            return value;
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    </script>
@endpush
