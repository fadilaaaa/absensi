@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>
        {{-- <div class="row">
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


        </div> --}}
        <div class="row mt-2">
            <div class="card" style="width: 100%">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Petugas</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-2" style="white-space: nowrap;">
                            <p>Nama</p>
                            <p>NIK</p>
                            <p>Tanggal Lahir</p>
                            <p>Alamat</p>
                            <p>Emil</p>
                            <p>No. Telepon</p>
                        </div>
                        <div class="col-1">
                            <p>:</p>
                            <p>:</p>
                            <p>:</p>
                            <p>:</p>
                            <p>:</p>
                            <p>:</p>
                        </div>
                        <div class="col-8">
                            <p>{{ $petugas->name }}</p>
                            <p>{{ $petugas->nik }}</p>
                            <p>{{ $petugas->tgl_lahir }}</p>
                            <p>{{ $petugas->alamat }}</p>
                            <p>{{ $petugas->email }}</p>
                            <p>{{ $petugas->no_telp }}</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
