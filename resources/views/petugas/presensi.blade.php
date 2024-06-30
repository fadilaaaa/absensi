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
                    <div class="card-body">
                        <div id="cam" style="width: 280px;
                        border:"></div>
                        <button id="take" class="btn btn-success">Foto</button>
                        <button class="btn btn-secondary" id="reset" hidden>Reset</button>
                    </div>
                </div>
            </div>
        </div>
        <input type="image" id="subIm">
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
        });
        document.getElementById('reset').addEventListener('click', function() {
            initcam();
            document.getElementById('reset').setAttribute('hidden', true);
            document.getElementById('take').removeAttribute('hidden');
            document.getElementById('subIm').removeAttribute('src');
        });
        initcam();
    </script>
@endpush
