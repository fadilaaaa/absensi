@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="card" style="width: 100%">
                <div class="card-body">
                    <div class="row">
                        <div class="col-2" style="white-space: nowrap;">
                            <p>Nama</p>
                            <p>Shift</p>
                            <p>Hari Kerja</p>
                            <p>Status</p>
                        </div>
                        <div class="col-1">
                            <p>:</p>
                            <p>:</p>
                            <p>:</p>
                            <p>:</p>
                        </div>
                        <div class="col-8">
                            <p>Arsa Fadila</p>
                            <p>07.00 - 15.00</p>
                            <p>Senin - Jumat</p>
                            <p>Belum Absen</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <hr class="solid></hr> --}}
        <div class="row mt-3 text-center">
            <div class="col-6 col-md-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <a href="/petugas/presensi" class="btn btn-link text-decoration-none">
                            <i class="fas fa-calendar-check fa-3x mb-2"></i>
                            <h5>Presensi</h5>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Lihat Gaji -->
            <div class="col-6 col-md-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <a href="/petugas/gaji" class="btn btn-link text-decoration-none">
                            <i class="fas fa-money-check-alt fa-3x mb-2"></i>
                            <h5>Lihat Gaji</h5>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Izin/Cuti -->
            <div class="col-6 col-md-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <a href="/petugas/izin" class="btn btn-link text-decoration-none">
                            <i class="fas fa-calendar-alt fa-3x mb-2"></i>
                            <h5>Izin/Cuti</h5>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Pengaduan -->
            <div class="col-6 col-md-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <a href="/petugas/pengaduan" class="btn btn-link text-decoration-none">
                            <i class="fas fa-comments fa-3x mb-2"></i>
                            <h5>Pengaduan</h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
