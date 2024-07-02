@extends('layouts.master')

@section('title', 'Pengajuan Izin/Cuti')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class=" col-md-10 col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Pengajuan Izin/Cuti</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('petugas/izin') }}" method="POST">
                            @csrf
                            <!-- Field Tanggal -->
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            </div>

                            <!-- Field Jenis Pengajuan -->
                            <div class="form-group">
                                <label for="jenisPengajuan">Jenis Pengajuan</label>
                                <select class="form-control" id="jenisPengajuan" name="jenisPengajuan" required>
                                    <option value="">Pilih Jenis Pengajuan</option>
                                    <option value="izin">Izin</option>
                                    <option value="cuti">Cuti</option>
                                </select>
                            </div>

                            <!-- Field Keterangan -->
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="4" placeholder="Masukkan keterangan..."
                                    required></textarea>
                            </div>

                            <!-- Tombol Submit -->
                            <button type="submit" class="btn btn-primary w-100">Ajukan</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Riwayat Pengajuan Izin/Cuti</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>

                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Jenis Pengajuan</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                        <td>23 Maret 2024</td>
                                        <td>Menunggu persetujuan</td>
                                        <td>Izin</td>
                                        <td>Perjalanan dinas ke luar kota</td>
                                    </tr>
                                    <tr>

                                        <td>22 Maret 2024</td>
                                        <td>Disetujui</td>
                                        <td>Cuti</td>
                                        <td>Cuti tahunan</td>
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
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "order": [0, 'desc'],
            });
        });
    </script>
@endpush
