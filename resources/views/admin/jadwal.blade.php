@extends('layouts.master')

@section('title', 'Jadwal Kerja')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-11">
                <div class="card shadow mb-1">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Buat Jadwal Kerja</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Nama Petugas</label>
                                    <input type="text" class="form-control">
                                    <label>NIK</label>
                                    <input type="text" class="form-control" id="nik">
                                    <label for="">Periode Bulan</label>
                                    <select class="form-control" id="periode_bulan">
                                        <option value="">Pilih Periode Bulan</option>
                                        <option value="1">Januari-Maret</option>
                                        <option value="2">April-Juni</option>
                                        <option value="3">Juli-September</option>
                                        <option value="4">Oktober-Desember</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Lokasi</label>
                                    <input type="text" class="form-control" id="alamat">
                                    <label>Waktu</label>
                                    <input type="text" class="form-control" id="tanggal_lahir">
                                    <label for="">Hari</label>
                                    <input type="text" class="form-control" id="email">
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
                        <h6 class="m-0 font-weight-bold text-primary">List Jadwal Petugas</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>Periode Bulan</th>
                                        <th>Lokasi</th>
                                        <th>Waktu</th>
                                        <th>Hari</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Ahmad Fauzi</td>
                                        <td>3201123456789012</td>
                                        <td>Januari-Maret</td>
                                        <td>Dolok Sabggul</td>
                                        <td>08.00 - 15.00</td>
                                        <td>Senin - Sabtu</td>
                                        <td class="action-column">
                                            <button data-toggle="modal" data-target="#exampleModal" data-nama="Ahmad Fauzi"
                                                data-nik="3201123456789012" data-periode="Januari-Maret"
                                                data-alamat="Dolok Sabggul" data-waktu="08.00 - 15.00"
                                                data-hari="Senin - Sabtu" class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <a data-confirm-delete="true" href="{{ url('admin/jadwal/99') }}"
                                                class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
                                    <label for="inputEmail4">Nama Petugas</label>
                                    <input name="nama" type="text" class="form-control">
                                    <label>NIK</label>
                                    <input name="nik" type="text" class="form-control">
                                    <label for="">Periode Bulan</label>
                                    <select name="periode" class="form-control">
                                        <option value="">Pilih Periode Bulan</option>
                                        <option value="Januari-Mei">Januari-Mei</option>
                                        <option value="Jubi-Desember">Jubi-Desember</option>

                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Lokasi</label>
                                    <input name="lokasi" type="text" class="form-control">
                                    <label>Waktu</label>
                                    <input name="waktu" type="text" class="form-control">
                                    <label for="">Hari</label>
                                    <input name="hari" type="text"class="form-control">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
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
        $('#periode_bulan').selectize({
            create: false
        });

        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var nama = button.data('nama');
            var nik = button.data('nik');
            var periode = button.data('periode');
            var alamat = button.data('alamat');
            var waktu = button.data('waktu');
            var hari = button.data('hari');
            var modal = $(this);
            modal.find('.modal-body input[name=nama]').val(nama);
            modal.find('.modal-body input[name=nik]').val(nik);
            modal.find('.modal-body select[name=periode]').val(periode);
            modal.find('.modal-body input[name=lokasi]').val(alamat);
            modal.find('.modal-body input[name=waktu]').val(waktu);
            modal.find('.modal-body input[name=hari]').val(hari);
        });
    </script>
@endpush

@push('styles')
    <link href="{{ url('/vendor/selectize-bootstrap4/dist/css/selectize.bootstrap4.css') }}" rel="stylesheet">
@endpush
