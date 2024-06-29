@extends('layouts.master')

@section('title', 'Akun Petugas')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-11">
                <div class="card shadow mb-1">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Buat Akun Petugas</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Username</label>
                                    <input type="text" class="form-control">
                                    <label for="inputPassword4">Password</label>
                                    <input type="password" class="form-control">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" id="nama">
                                    <label>NIK</label>
                                    <input type="text" class="form-control" id="nik">

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Alamat</label>
                                    <input type="text" class="form-control" id="alamat">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" id="email">
                                    <label for="">No. Telepon</label>
                                    <input type="text" class="form-control" id="no_telepon">
                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <input type="submit" class="btn btn-primary btn-user btn-block" value="submit">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="reset" class="btn btn-danger btn-user btn-block" value="Batal">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-11">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">List Akun Petugas</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>Tgl Lahir</th>
                                        <th>Alamat</th>

                                        <th>No. Telepon</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Ahmad Fauzi</td>
                                        <td>3201123456789012</td>
                                        <td>1985-05-14</td>
                                        <td>Jl. Melati No. 10, Jakarta</td>
                                        <td>081234567890</td>
                                        <td class="action-column">
                                            <button data-toggle="modal" data-target="#exampleModal" data-nama="Ahmad Fauzi"
                                                data-nik="3201123456789012" data-tgl-lahir="1985-05-14"
                                                data-alamat="Jl. Melati No. 10, Jakarta" data-telepon="081234567890"
                                                class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <a data-confirm-delete="true" href="{{ url('admin/akun-petugas/99') }}"
                                                class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Siti Rahmawati</td>
                                        <td>3201123456789013</td>
                                        <td>1990-08-21</td>
                                        <td>Jl. Kenanga No. 20, Bandung</td>
                                        <td>081234567891</td>
                                        <td class="action-column">
                                            <button class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <a data-confirm-delete="true" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Budi Santoso</td>
                                        <td>3201123456789014</td>
                                        <td>1978-11-05</td>
                                        <td>Jl. Mawar No. 5, Surabaya</td>
                                        <td>081234567892</td>
                                        <td class="action-column">
                                            <button class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Lina Kartika</td>
                                        <td>3201123456789015</td>
                                        <td>1982-03-30</td>
                                        <td>Jl. Dahlia No. 15, Yogyakarta</td>
                                        <td>081234567893</td>
                                        <td class="action-column">
                                            <button class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Agus Prasetyo</td>
                                        <td>3201123456789016</td>
                                        <td>1987-07-19</td>
                                        <td>Jl. Anggrek No. 7, Semarang</td>
                                        <td>081234567894</td>
                                        <td class="action-column">
                                            <button class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Indah Permatasari</td>
                                        <td>3201123456789017</td>
                                        <td>1992-09-14</td>
                                        <td>Jl. Melur No. 21, Malang</td>
                                        <td>081234567895</td>
                                        <td class="action-column">
                                            <button class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>Rudi Setiawan</td>
                                        <td>3201123456789018</td>
                                        <td>1980-12-05</td>
                                        <td>Jl. Seroja No. 18, Medan</td>
                                        <td>081234567896</td>
                                        <td class="action-column">
                                            <button class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>Yuni Anggraini</td>
                                        <td>3201123456789019</td>
                                        <td>1991-06-22</td>
                                        <td>Jl. Melati No. 9, Palembang</td>
                                        <td>081234567897</td>
                                        <td class="action-column">
                                            <button class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>Eko Wibowo</td>
                                        <td>3201123456789020</td>
                                        <td>1979-04-10</td>
                                        <td>Jl. Teratai No. 12, Bali</td>
                                        <td>081234567898</td>
                                        <td class="action-column">
                                            <button class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>Rina Oktaviani</td>
                                        <td>3201123456789021</td>
                                        <td>1988-10-15</td>
                                        <td>Jl. Kemuning No. 8, Balikpapan</td>
                                        <td>081234567899</td>
                                        <td class="action-column">
                                            <button class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Akun Petugas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputUsername">Username</label>
                                <input type="text" class="form-control" id="inputUsername">
                                <label for="inputPassword">Password</label>
                                <input type="password" class="form-control" id="inputPassword">
                                <label for="inputNama">Nama</label>
                                <input type="text" class="form-control" id="inputNama">
                                <label>NIK</label>
                                <input type="text" class="form-control" id="inputNik">

                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputAlamat">Alamat</label>
                                <input type="text" class="form-control" id="inputAlamat">
                                <label for="inputTanggalLahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="inputTanggalLahir">
                                <label for="inputEmail">Email</label>
                                <input type="email" class="form-control" id="inputEmail">
                                <label for="inputTelepon">No. Telepon</label>
                                <input type="text" class="form-control" id="inputTelepon">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "searching": true,
            });
        });
    </script>
    <script>
        // Tunggu hingga DOM siap
        document.addEventListener('DOMContentLoaded', function() {
            // Seleksi semua tombol edit
            var editButtons = document.querySelectorAll('button[data-toggle="modal"]');

            // Tambahkan event listener pada setiap tombol
            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    // Ambil data dari atribut data-
                    var nama = button.getAttribute('data-nama');
                    var nik = button.getAttribute('data-nik');
                    var tanggalLahir = button.getAttribute('data-tgl-lahir');
                    var alamat = button.getAttribute('data-alamat');
                    var telepon = button.getAttribute('data-telepon');

                    document.getElementById('inputNama').value = nama;
                    document.getElementById('inputNik').value = nik;
                    document.getElementById('inputTanggalLahir').value = tanggalLahir;
                    document.getElementById('inputAlamat').value = alamat;
                    document.getElementById('inputTelepon').value = telepon;

                    document.getElementById('inputUsername').value = 'blablabla';
                    document.getElementById('inputPassword').value = '';
                    document.getElementById('inputEmail').value = 'blablablabla@email.com';
                });
            });
        });
    </script>
    <script>
        @if (session('success'))
            // swal("Berhasil!", "{{ session('success') }}", "success");
            var toastMixin = Swal.mixin({
                toast: true,
                icon: 'success',
                title: 'General Title',
                animation: false,
                position: 'top-right',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
            toastMixin.fire({
                animation: true,
                title: '{{ session('success') }}'
            });
        @endif
    </script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endpush
@push('styles')
    <style>
        /* Set a fixed width for the action column */
        .action-column {
            width: 120px;
            white-space: nowrap;
        }

        /* Ensure buttons are displayed inline */
        .action-column button {
            margin: 0 2px;
        }
    </style>
@endpush
