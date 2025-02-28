@extends('layouts.master')

@section('title', 'Jadwal Kerja')
@push('styles')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
@endpush
@push('scripts')
    <!-- Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
@endpush

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
                        <form action="{{ url('admin/jadwal') }}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Nama Petugas</label>
                                    {{-- <input type="text" class="form-control"> --}}
                                    <select class="form-control" name="nama" id="nama"></select>
                                    <label>NIK</label>
                                    <select class="form-control" name="nik" id="nik"></select>
                                    <label for="">Periode Bulan</label>
                                    <select name="periode" class="form-control" id="periode_bulan">
                                        <option value="">Pilih Periode Bulan</option>
                                        <option value="Januari-Mei">Januari-Mei</option>
                                        <option value="Juni-Desember">Juni-Desember</option>
                                    </select>
                                    <button type="button"
                                    class="btn btn-info mt-3" data-toggle="modal" data-target="#mapModal">Pilih Titik dan Radius
                                    </button>
<!-- Modal -->
<div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mapModalLabel">Pilih Titik dan Radius</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="radius">Radius (meter)</label>
                    <input type="number" class="form-control" id="radius" name="radius" min="0">
                </div>
                <div id="map" style="height: 400px;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="saveLocation">Simpan</button>
            </div>
        </div>
    </div>
</div>

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Lokasi</label>
                                    <input name="lokasi" type="text" class="form-control" id="alamat">
                                    <label>Waktu</label>
                                    <input name="waktu" type="text" class="form-control" id="tanggal_lahir">
                                    <label for="">Hari</label>
                                    <input name="hari" type="text" class="form-control" id="email">
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
                            {{-- <div id="map" style="height: 300px;"></div> --}}
                            <input type="hidden" name="latitude" id="latitude">
                            <input type="hidden" name="longitude" id="longitude">
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
                                    @foreach ($jadwal as $item)
                                        @if ($item->petugas == null)
                                            @continue
                                        @endif
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->petugas->name }}</td>
                                            <td>{{ $item->petugas->nik }}</td>
                                            <td>{{ $item->periode }}</td>
                                            <td>{{ $item->lokasi }}</td>
                                            <td>{{ $item->waktu }}</td>
                                            <td>{{ $item->hari }}</td>
                                            <td class="action-column" style="white-space: nowrap">
                                                <button data-toggle="modal" data-target="#exampleModal"
                                                    data-nama="{{ $item->petugas->name }}"
                                                    data-nik="{{ $item->petugas->nik }}"
                                                    data-periode="{{ $item->periode }}" data-alamat="{{ $item->lokasi }}"
                                                    data-waktu="{{ $item->waktu }}" data-hari="{{ $item->hari }}"
                                                    data-action="{{ url('admin/jadwal/' . $item->id) }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <a data-confirm-delete="true" href="{{ url('admin/jadwal/' . $item->id) }}"
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
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" id="formEdit">
                    @csrf
                    @method('put')
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
                                    <select class="form-control" name="nama" id="editNama"></select>
                                    {{-- <input id="editNama" name="nama" type="text" class="form-control"> --}}
                                    <label>NIK</label>
                                    {{-- <input id="editNik" name="nik" type="text" class="form-control"> --}}
                                    <select name="nik" id="editNik" class="form-control"></select>
                                    <label for="">Periode Bulan</label>
                                    <select name="periode" class="form-control">
                                        <option value="">Pilih Periode Bulan</option>
                                        <option value="Januari-Mei">Januari-Mei</option>
                                        <option value="Juni-Desember">Juni-Desember</option>

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
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        // Inisialisasi peta
        var map = L.map('map').setView([2.2613970893346202, 98.749640603538], 15); // Set view ke Jakarta

        // Tambahkan tile layer (peta dasar)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Pin Peta untuk penugasan titik lokasi'
        }).addTo(map);

        // Variabel untuk menyimpan marker
        var marker = null;

        // Fungsi untuk menambahkan pin saat peta diklik
        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            // Hapus marker sebelumnya jika ada
            if (marker) {
                map.removeLayer(marker);
            }

            // Tambahkan marker baru
            marker = L.marker([lat, lng]).addTo(map);

            // Isi nilai latitude dan longitude ke input hidden
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        });
        $('#mapModal').on('show.bs.modal', function(){
  setTimeout(function() {
    map.invalidateSize();
  }, 1);
 });
    </script>
    <script>
        const dataPetugas = @json($petugas);
        // const niks = dataPetugas.map(petugas => petugas.nik);
        $(document).ready(function() {
            $('#nik').selectize({
                valueField: 'nik',
                labelField: 'nik',
                searchField: 'nik',
                options: dataPetugas.map(petugas => ({
                    nik: petugas.nik
                })),
                create: false,
                onChange: function(value) {
                    const petugas = dataPetugas.find(petugas => petugas.nik === value);
                    if (petugas.name !== $('#nama')[0].selectize.getValue()) {
                        console.log(petugas.name, $('#nama')[0].selectize.getValue());
                        $('#nama')[0]
                            .selectize.setValue(petugas.name);
                    }
                    // console.log($('#nama')[0].selectize.getValue());;
                }
            });
            $('#editNik').selectize({
                valueField: 'nik',
                labelField: 'nik',
                searchField: 'nik',
                options: dataPetugas.map(petugas => ({
                    nik: petugas.nik
                })),
                create: false,
                onChange: function(value) {
                    const petugas = dataPetugas.find(petugas => petugas.nik === value);
                    if (petugas.name !== $('#editNama')[0].selectize.getValue()) {
                        $('#editNama')[0]
                            .selectize.setValue(petugas.name);
                    }
                    // console.log($('#nama')[0].selectize.getValue());;
                }
            });
            $('#nama').selectize({
                valueField: 'name',
                labelField: 'name',
                searchField: 'name',
                options: dataPetugas.map(petugas => ({
                    name: petugas.name
                })),
                create: false,
                onChange: function(value) {
                    const petugas = dataPetugas.find(petugas => petugas.name === value);
                    if (petugas.nik !== $('#nik')[0].selectize.getValue()) {
                        console.log(petugas.nik, $('#nik')[0].selectize.getValue());
                        $('#nik')[0].selectize.setValue(petugas.nik);
                    }
                }
            });
            $('#editNama').selectize({
                valueField: 'name',
                labelField: 'name',
                searchField: 'name',
                options: dataPetugas.map(petugas => ({
                    name: petugas.name
                })),
                create: false,
                onChange: function(value) {
                    const petugas = dataPetugas.find(petugas => petugas.name === value);
                    if (petugas.nik !== $('#editNik')[0].selectize.getValue()) {
                        $('#editNik')[0].selectize.setValue(petugas.nik);
                    }
                }
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
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var nama = button.data('nama');
            var nik = button.data('nik');
            var periode = button.data('periode');
            var alamat = button.data('alamat');
            var waktu = button.data('waktu');
            var hari = button.data('hari');
            var modal = $(this);
            $('#editNama')[0].selectize.setValue(nama);
            $('#editNik')[0].selectize.setValue(nik);
            modal.find('.modal-body select[name=periode]').val(periode);
            modal.find('.modal-body input[name=lokasi]').val(alamat);
            modal.find('.modal-body input[name=waktu]').val(waktu);
            modal.find('.modal-body input[name=hari]').val(hari);
            $('#formEdit').attr('action', button.data('action'));
        });
    </script>
@endpush

@push('styles')
    <link href="{{ url('/vendor/selectize-bootstrap4/dist/css/selectize.bootstrap4.css') }}" rel="stylesheet">
@endpush
