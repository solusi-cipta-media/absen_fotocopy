@extends('template.app')
@section('content')
    <style>
        #body-modal {
            padding: 1rem;
        }
    </style>
    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        <div class="content">
            <div class="col-md-6 col-xl-12">
                <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <img class="img-avatar" src="{{ asset(auth()->user()->foto) }}" alt="">
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light">
                        <div class="fw-semibold mb-1">{{ auth()->user()->nama }}</div>
                        <div class="fs-sm text-muted">{{ ucwords(auth()->user()->role) }}</div>
                        <div class="bg-primary rounded text-light mt-2 p-1">
                            <span class="fw-bolder" id="time">
                                00:00
                            </span>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="row items-push text-center">
                            <div class="col">
                                <button type="button" class="btn btn-success" onclick="open_clock('in')">
                                    <i class="nav-main-link-icon fa fa-clock"></i>
                                    In
                                </button>
                                <button type="button" class="btn btn-primary" onclick="open_clock('out')">
                                    <i class="nav-main-link-icon fa fa-clock"></i>
                                    Out
                                </button>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Normal Modal -->
            <div class="modal" id="modal_clock" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="block block-rounded shadow-none mb-0">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Foto <span id="type"></span></h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content fs-sm" id="body-modal">
                                <form action="#" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" readonly name="latitude">
                                    <input type="hidden" readonly name="longitude">
                                    <div class="row">
                                        <div class="col-12" id="camera">
                                            <div id="my_camera" class="w-100"></div>
                                            <input type="hidden" readonly name="image" class="image-tag">
                                        </div>
                                        <div class="col-12" id="preview">
                                            <div id="results">Your captured image will appear here...</div>
                                        </div>
                                    </div>
                            </div>
                            <div class="block-content block-content-full block-content-sm text-end border-top">
                                <input type=button class="btn btn-sm btn-primary" value="Ambil Foto"
                                    onClick="take_snapshot()">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <button type="reset" class="btn btn-alt-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Normal Modal -->
            <!-- Dynamic Table Responsive -->
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.js"
        integrity="sha512-AQMSn1qO6KN85GOfvH6BWJk46LhlvepblftLHzAv1cdIyTWPBKHX+r+NOXVVw6+XQpeW4LJk/GTmoP48FLvblQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
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
    </script>
@endsection
