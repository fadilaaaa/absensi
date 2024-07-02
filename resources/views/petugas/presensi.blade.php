@extends('layouts.master')

@section('title', 'Presensi')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-11">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data Presensi Petugas</h6>
                    </div>
                    <div class="card-body"
                        style="display: flex;
                    justify-content: center;align-items: center">
                        <div id="cam" style="width: 280px;
                        border:"></div>
                    </div>
                    <div class="mb-2 row" style="display: flex;align-items: center;justify-content: center">
                        <button id="take" class="btn btn-success">Foto</button>
                        <button class="btn btn-secondary" id="reset" hidden>Reset</button>
                        <div class="col-12" style="display: flex;align-items: center;justify-content: center"><button
                                class="btn btn-primary mt-2" id="submit" hidden>Absen Masuk</button></div>
                    </div>
                    <a href="{{ url('petugas/presensi/riwayat/99') }}" class="btn btn-warning">Lihat Riwayat Presensi</a>
                </div>
            </div>
        </div>
        <input type="image" id="subIm" hidden>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <script>
        function initcam() {
            Webcam.set({
                width: 280,
                height: 240,
                image_format: 'jpeg',
                jpeg_quality: 90
            });
            Webcam.attach('#cam');
        }
        document.getElementById('take').addEventListener('click', function() {
            Webcam.snap(function(data_uri) {
                document.getElementById('cam').innerHTML = '<img src="' + data_uri + '"/>';
                document.getElementById('subIm').src = data_uri;
            });
            document.getElementById('reset').removeAttribute('hidden');
            document.getElementById('take').setAttribute('hidden', true);
            document.getElementById('submit').removeAttribute('hidden');
        });
        document.getElementById('reset').addEventListener('click', function() {
            initcam();
            document.getElementById('reset').setAttribute('hidden', true);
            document.getElementById('take').removeAttribute('hidden');
            document.getElementById('subIm').removeAttribute('src');
            document.getElementById('submit').setAttribute('hidden', true);
        });
        document.getElementById('submit').addEventListener('click', function() {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data yang sudah di submit tidak dapat diubah!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Submit'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ url('petugas/presensi/riwayat') }}";
                }
            });
        });
        initcam();
    </script>
@endpush
