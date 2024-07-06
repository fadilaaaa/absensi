@extends('layouts.master')

@section('title', 'Riwayat Presensi')

@section('content')
    {{-- @dd($presensi) --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-11">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Riwayat Presensi</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Lokasi</th>
                                        <th>Masuk</th>
                                        <th>Keluar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @dd($presensi[0]->petugas->jadwal) --}}
                                    @foreach ($presensi as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                                            <td>{{ $item->petugas->jadwal[0]->lokasi }}</td>
                                            <td>{{ date('H:i', strtotime($item->waktu_masuk)) }}</td>
                                            <td>{{ date('H:i', strtotime($item->waktu_keluar)) }}</td>
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

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "pageLength": 5,
                "pagingType": "simple_numbers",
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
            $('#dataTable_length').parent().hide()
            $('#dataTable_filter').parent().addClass('col-md-12')
            $('#dataTable_info').parent().parent().prepend(`
            <div class="col-12" style="display: flex;justify-content: right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Export Excel
                </button>
            </div>
            `)
        });
    </script>
@endpush
