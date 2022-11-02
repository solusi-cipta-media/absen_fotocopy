@extends('template.app')
@section('content')
    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        <div class="content">
            <div class="col-md-6 col-xl-12">
                <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <h3 style="margin-bottom: 0px">Pengajuan Cuti</h3>
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="row mb-3">
                                <label for="tanggal" class="col-form-label col-xl-2 col-md-6">Tanggal</label>
                                <div class="col-md-6 col-xl-10">
                                    <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="cuti" class="col-form-label col-xl-2 col-md-6">Jenis Cuti</label>
                                <div class="col-md-6 col-xl-10">
                                    <select name="cuti" id="cuti" class="form-select" required>
                                        <option value="">Izin/Sakit</option>
                                        @foreach ($cutis as $cuti)
                                            <option value="{{ $cuti->id }}">{{ $cuti->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3" id="bukti">
                                <label for="bukti" class="col-form-label col-xl-2 col-md-6">Bukti Foto</label>
                                <div class="col-md-6 col-xl-10">
                                    <input type="file" name="bukti" id="bukti" class="form-control"
                                        accept="image/png, image/jpeg" multiple>
                                </div>
                            </div>
                    </div>
                    <div class="block-content">
                        <div class="row items-push text-center">
                            <div class="col">
                                <button type="submit" class="btn btn-success">
                                    Submit
                                </button>
                                <button type="reset" class="btn btn-danger" onclick="open_clock('out')">
                                    Reset
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>
                </a>
            </div>

            <!-- Dynamic Table Responsive -->
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
    <script>
        $("select[name='cuti']").on('change', function() {
            if ($(this).val() === '') {
                $("div[id='bukti']").show();
            } else {
                $("div[id='bukti']").hide();
            }
        })
    </script>
    {{-- <script>
        var typeClock = 'in';

        function live_time() {
            var today = new Date()
            const hours = today.getHours();
            const minutes = today.getMinutes();
            const seconds = today.getSeconds();

            //add '0' to hour, minute & second when they are less 10
            const hour = hours < 10 ? "0" + hours : hours;
            const minute = minutes < 10 ? "0" + minutes : minutes;
            const second = seconds < 10 ? "0" + seconds : seconds;

            document.getElementById('time').innerHTML = hour + ':' + minute + ':' + second;
        }

        setInterval(live_time, 1000);

        function open_clock(type) {
            typeClock = type;
            $('#modal_clock').modal('show');
            Webcam.set({
                width: 440,
                height: 330,
                image_format: 'jpeg',
                jpeg_quality: 90
            });

            Webcam.attach('#my_camera');
            $("#camera").show();
            $("#preview").hide();
            $("input[value='Ambil Foto']").show();
            $("button[type='submit']").hide();
            $('#my_camera').addClass('w-100');
            $('#my_camera').removeAttr('style');
            $('#my_camera video').addClass('w-100');
            $('#my_camera video').removeAttr('style');
        }

        function take_snapshot() {
            Webcam.snap(function(data_uri) {
                $(".image-tag").val(data_uri);
                document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
                $("#camera").hide();
                $("input[value='Ambil Foto']").hide();
                $("button[type='submit']").show();
                $("#preview").show();
                $('#results img').addClass('w-100 h-100');
            });
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    $('input[name="latitude"]').val(position.coords.latitude);
                    $('input[name="longitude"]').val(position.coords.longitude);
                });
            } else {
                alert("Sorry, your browser does not support HTML5 geolocation.");
            }
        }

        $('form').on('submit', function(event) {
            event.preventDefault();
            if (typeClock == 'in') {
                var url = "{{ route('absen.in') }}";
            } else {
                var url = "{{ route('absen.out') }}";
            }
            var lat = $('input[name="latitude"]').val();
            var long = $('input[name="longitude"]').val();
            var image = $('input[name="image"]').val();
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            });
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    latitude: lat,
                    longitude: long,
                    image: image
                },
                success: function(res) {
                    Swal.fire(
                        'Success!',
                        'Berhasil melakukan absensi.',
                        'success'
                    )
                },
                error: function(res) {
                    var errors = res.responseJSON;
                    var message;
                    if (errors.message != null) {
                        message = errors.message;
                    } else {
                        message = 'Error tidak diketahui';
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Errors',
                        text: message,
                    });
                }
            });
        });
    </script> --}}
@endsection
