@extends('layouts.master')

@section('title', 'Form Pengaduan')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-10 col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Form Pengaduan</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('petugas/izin') }}" method="POST">
                            @csrf
                            <!-- Field Tanggal -->
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            </div>

                            <div class="form-group">
                                <label for="">Lokasi</label>
                                <input type="text" class="form-control" id="lokasi" name="lokasi" required>
                            </div>

                            <div class="form-group">
                                <label for="">Bukti Pendukung</label>
                                <div class="text-center mb-2">
                                    <img id="imgprev" style="width: 100px;height: auto;" src="" alt=""
                                        srcset="" hidden>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="file"
                                            aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
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

        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const file = document.getElementById('file');
        file.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function() {
                    const img = document.querySelector('#imgprev');
                    img.src = reader.result;
                    img.hidden = false;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
