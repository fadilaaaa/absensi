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
                        <form action="{{ url('admin/akun-petugas') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Username</label>
                                    <input name="username" type="text" class="form-control">
                                    <label for="inputPassword4">Password</label>
                                    <input name="password" type="password" class="form-control">
                                    <label>Nama</label>
                                    <input name="nama" type="text" class="form-control" id="nama">
                                    <label>NIK</label>
                                    <input name="nik" type="text" class="form-control" id="nik">

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Alamat</label>
                                    <input name="alamat" type="text" class="form-control" id="alamat">
                                    <label>Tanggal Lahir</label>
                                    <input name="tgl_lahir" type="date" class="form-control" id="tanggal_lahir">
                                    <label for="">Email</label>
                                    <input name="email" type="email" class="form-control" id="email">
                                    <label for="">No. Telepon</label>
                                    <input name="no_telp" type="text" class="form-control" id="no_telepon">
                                    <div class="row mt-4" style="display: flex;justify-content: center">
                                        <div class="col-md-3">
                                            <input type="button" class="btn btn-warning btn-user btn-block"
                                                value="Import Akun">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="submit" class="btn btn-primary btn-user btn-block" value="submit">
                                        </div>
                                        <div class="col-md-3">
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

                                    @foreach ($petugas as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->nik }}</td>
                                            <td>{{ $item->tgl_lahir }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            <td>{{ $item->no_telp }}</td>
                                            <td class="action-column">
                                                <button data-toggle="modal" data-target="#exampleModal"
                                                    data-nama="{{ $item->name }}" data-nik="{{ $item->nik }}"
                                                    data-tgl-lahir="{{ $item->tgl_lahir }}"
                                                    data-alamat="{{ $item->alamat }}" data-telepon="{{ $item->no_telp }}"
                                                    data-email="{{ $item->email }}"
                                                    data-username="{{ $item->user->username }}"
                                                    data-action="{{ url('admin/akun-petugas/' . $item->id) }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <a data-confirm-delete="true"
                                                    href="{{ url('admin/akun-petugas/' . $item->id) }}"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
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
            <form id="modalForm" method="POST">
                @csrf
                @method('PUT')
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
                                <input name="username" type="text" class="form-control" id="inputUsername">
                                <label for="inputPassword">Password</label>
                                <input name="password" type="password" class="form-control" id="inputPassword">
                                <label for="inputNama">Nama</label>
                                <input name="nama" type="text" class="form-control" id="inputNama">
                                <label>NIK</label>
                                <input name="nik" type="text" class="form-control" id="inputNik">

                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputAlamat">Alamat</label>
                                <input name="alamat" type="text" class="form-control" id="inputAlamat">
                                <label for="inputTanggalLahir">Tanggal Lahir</label>
                                <input name="tgl_lahir" type="date" class="form-control" id="inputTanggalLahir">
                                <label for="inputEmail">Email</label>
                                <input name="email" type="email" class="form-control" id="inputEmail">
                                <label for="inputTelepon">No. Telepon</label>
                                <input name="no_telp" type="text" class="form-control" id="inputTelepon">
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
                    var email = button.getAttribute('data-email');
                    var username = button.getAttribute('data-username');

                    document.getElementById('inputNama').value = nama;
                    document.getElementById('inputNik').value = nik;
                    document.getElementById('inputTanggalLahir').value = tanggalLahir;
                    document.getElementById('inputAlamat').value = alamat;
                    document.getElementById('inputTelepon').value = telepon;

                    document.getElementById('inputUsername').value = username;
                    document.getElementById('inputEmail').value = email;
                    document.getElementById('modalForm').action = button.getAttribute(
                        'data-action');
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
