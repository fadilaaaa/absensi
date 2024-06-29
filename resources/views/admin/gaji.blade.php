@extends('layouts.master')

@section('title', 'Penggajian')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-11">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data Gaji Petugas</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>Gaji</th>
                                        <th>Potongan</th>
                                        <th>Total Gaji</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Ahmad Fauzi</td>
                                        <td>3201123456789012</td>
                                        <td>Rp. 150.000</td>
                                        <td>Rp. 20.000</td>
                                        <td>Rp. 130.000</td>
                                        <td class="action-column">
                                            <button data-confirm-izin="true" class="btn btn-sm btn-primary">
                                                <i class="fas fa-signal"></i>
                                            </button>
                                            <button data-confirm-izin="true" class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <a data-confirm-delete="true" class="btn btn-sm btn-secondary">
                                                <i class="fas fa-print"></i>
                                            </a>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "order": [
                    [0, "desc"]
                ]
            });
            const dataFilterBox = $('#dataTable_filter');
            dataFilterBox.prepend(`<label style="display: flex;margin-bottom: 0.5rem;align-items: center;">Filter:
        <div class="input-group mx-1">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Bulan</label>
            </div>
            <select class="custom-select" id="inputGroupSelect01">
                <option selected>Pilih</option>
                <option value="Januari">Januari</option>
                <option value="Februari">Februari</option>
                <option value="Maret">Maret</option>
                <option value="April">April</option>
                <option value="Mei">Mei</option>
                <option value="Juni">Juni</option>
                <option value="Juli">Juli</option>
                <option value="Agustus">Agustus</option>
                <option value="September">September</option>
                <option value="Oktober">Oktober</option>
                <option value="November">November</option>
                <option value="Desember">Desember</option>
            </select>
        </div>
        <div class="input-group mx-1">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Tahun</label>
            </div>
            <select class="custom-select" id="inputGroupSelect01">
                <option selected>Pilih</option>
                <option value="2024">2024</option>
                <option value="2023">2023</option>
            </select>
        </div>
    </label>`);
            dataFilterBox.css({
                "display": "flex",
                "justify-content": "space-between",
                "align-items": "center"
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#dataTable_length').hide()
        });
    </script>
@endpush
