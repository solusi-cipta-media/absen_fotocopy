@extends('template.app')

@section('content')
    <!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <!-- User Info -->
    <div class="bg-image bg-image-bottom" style="background-image: url('{{ asset("media/photos/photo13@2x.jpg") }}');">
        <div class="bg-black-75 py-4">
            <div class="content content-full text-center">
                <!-- Avatar -->
                <div class="mb-3">
                    <a class="img-link" href="{{ asset(auth()->user()->foto) }}">
                        <img class="img-avatar img-avatar96 img-avatar-thumb" src="{{ asset(auth()->user()->foto) }}" alt="">
                    </a>
                </div>
                <!-- END Avatar -->

                <!-- Personal -->
                <h1 class="h3 text-white fw-bold mb-2">{{ auth()->user()->nama }}</h1>
                    @if (auth()->user()->role === 'admin')
                        <h2 class="h5 text-white-75">Administrator</h2>
                    @elseif (auth()->user()->role === 'supervisor')
                        <h2 class="h5 text-white-75">Supervisor</h2>
                    @endif
                
                <!-- END Personal -->

                <!-- Actions -->
                {{-- <a href="{{ route('profil') }}" class="btn btn-primary">
                    <i class="fa fa-arrow-left opacity-50 me-1"></i> Back to Profile
                </a> --}}
                <!-- END Actions -->
            </div>
        </div>
    </div>
    <!-- END User Info -->

    <!-- Main Content -->
    <div class="content">
        <!-- User Profile -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <i class="fa fa-user-circle me-1 text-muted"></i> User Profile
                </h3>
            </div>
            <div class="block-content">
                <form id="update_user" action="{{ route('profil.user') }}" method="POST" enctype="multipart/form-data">
                    <div class="row items-push">
                        @csrf
                        <div class="col-lg-3">
                            <p class="text-muted">
                                Informasi akun Anda, Username Anda akan tampil dan bisa dilihat oleh pengguna lain.
                            </p>
                        </div>
                        <div class="col-lg-7 offset-lg-1">
                            <div class="mb-4">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Enter your username.." value="{{ auth()->user()->email }}" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="nama">Nama</label>
                                <input type="text" class="form-control form-control-lg" id="nama" name="nama" placeholder="Enter your name.." value="{{ auth()->user()->nama }}" required>
                            </div>
                            {{-- <div class="mb-4">
                                <label class="form-label" for="profile-settings-email">Email Address</label>
                                <input type="email" class="form-control form-control-lg" id="profile-settings-email" name="profile-settings-email" placeholder="Enter your email.." value="john.doe@example.com">
                            </div> --}}
                            <div class="row mb-4">
                                <div class="col-md-10 col-xl-6">
                                    <div class="push">
                                        <img class="img-avatar" src="{{ asset(auth()->user()->foto) }}" alt="">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="foto" class="form-label">Pilih foto baru</label>
                                        <input class="form-control" type="file" id="foto" name="foto" multiple required accept="image/png, image/jpeg">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <button type="submit" class="btn btn-alt-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END User Profile -->

        <!-- Connections -->
        <!-- <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <i class="fa fa-share-alt me-1 text-muted"></i> Connections
                </h3>
            </div>
            <div class="block-content">
                <form action="be_pages_generic_profile.edit.html" method="POST" onsubmit="return false;">
                    <div class="row items-push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                You can connect your account to third party networks to get extra features.
                            </p>
                        </div>
                        <div class="col-lg-7 offset-lg-1">
                            <div class="row mb-4">
                                <div class="col-sm-10 col-md-8 col-xl-6">
                                    <a class="btn w-100 text-start btn-alt-danger bg-white" href="javascript:void(0)">
                                        <i class="fab fa-google me-1"></i> john_doe
                                    </a>
                                </div>
                                <div class="col-sm-12 col-md-4 col-xl-6 mt-1 d-flex align-items-center">
                                    <a class="text-muted" href="javascript:void(0)">
                                        <i class="fa fa-pencil-alt me-1"></i> Edit Google Connection
                                    </a>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-10 col-md-8 col-xl-6">
                                    <a class="btn w-100 text-start btn-alt-info bg-white" href="javascript:void(0)">
                                        <i class="fa fab fa-twitter me-1"></i> @john_doe
                                    </a>
                                </div>
                                <div class="col-sm-12 col-md-4 col-xl-6 mt-1 d-md-flex align-items-md-center">
                                    <a class="text-muted" href="javascript:void(0)">
                                        <i class="fa fa-pencil-alt me-1"></i> Edit Twitter Connection
                                    </a>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-10 col-md-8 col-xl-6">
                                    <a class="btn w-100 text-start btn-alt-primary" href="javascript:void(0)">
                                        <i class="fab fa-facebook-f me-1"></i> Connect to Facebook
                                    </a>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-10 col-md-8 col-xl-6">
                                    <a class="btn w-100 text-start btn-alt-warning" href="javascript:void(0)">
                                        <i class="fab fa-instagram me-1"></i> Connect to Instagram
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div> -->
        <!-- END Connections -->

        <!-- Change Password -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <i class="fa fa-asterisk me-1 text-muted"></i> Ganti Password
                </h3>
            </div>
            <div class="block-content">
                <form id="update_password" action="" method="POST">
                    <div class="row items-push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                Ubah password Anda secara berkala untuk menjaga agar akun Anda tetap aman.
                            </p>
                        </div>
                        <div class="col-lg-7 offset-lg-1">
                            <div class="mb-4">
                                <label class="form-label" for="password">Password Saat Ini</label>
                                <input type="password" class="form-control form-control-lg" id="password" name="password" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="npassword">Password Baru</label>
                                <input type="password" class="form-control form-control-lg" id="npassword" name="npassword" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="npassword_confirmation">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control form-control-lg" id="npassword_confirmation" name="npassword_confirmation" required>
                            </div>
                            <div class="mb-4">
                                <button type="submit" class="btn btn-alt-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Change Password -->

        <!-- Billing Information -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <i class="far fa-address-card me-1 text-muted"></i> Informasi Pribadi
                </h3>
            </div>
            <div class="block-content">
                <form id="update_informasi" action="" method="POST">
                    <div class="row items-push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                Informasi pribadi Anda hanya akan digunakan untuk kepentingan perusahaan, tidak untuk di share ke pihak lain.
                            </p>
                        </div>
                        <div class="col-lg-7 offset-lg-1">
                            <div class="mb-4">
                                <label class="form-label" for="nama">Nama Lengkap</label>
                                <input type="text" class="form-control form-control-lg" id="nama" name="nama" value="{{ auth()->user()->nama }}" required>
                            </div>
                            <!-- <div class="row mb-4">
                                <div class="col-6">
                                    <label class="form-label" for="profile-settings-firstname">Firstname</label>
                                    <input type="text" class="form-control form-control-lg" id="profile-settings-firstname" name="profile-settings-firstname">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="profile-settings-lastname">Lastname</label>
                                    <input type="text" class="form-control form-control-lg" id="profile-settings-lastname" name="profile-settings-lastname">
                                </div>
                            </div> -->
                            <div class="mb-4">
                                <label class="form-label" for="alamat">Alamat</label>
                                <textarea name="alamat" class="form-control form-control-lg" id="alamat" cols="30" rows="10" required>{{ auth()->user()->alamat }}</textarea>
                                {{-- <input type="text" class="form-control form-control-lg" id="alamat" name="alamat" value="{{ auth()->user()->alamat }}"> --}}
                            </div>
                            {{-- <div class="mb-4">
                                <label class="form-label" for="profile-settings-street-2">Alamat 2 (Jika Ada)</label>
                                <input type="text" class="form-control form-control-lg" id="profile-settings-street-2" name="profile-settings-street-2">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="profile-settings-city">Kota</label>
                                <input type="text" class="form-control form-control-lg" id="profile-settings-city" name="profile-settings-city">
                            </div> --}}
                            <div class="row mb-4">
                                <div class="col-6">
                                    <label class="form-label" for="telepon">Handphone</label>
                                    <input type="text" class="form-control form-control-lg" id="telepon" name="telepon" value="{{ auth()->user()->telepon }}" required>
                                </div>
                            </div>
                            <!-- <div class="row mb-4">
                                <div class="col-6">
                                    <label class="form-label" for="profile-settings-vat">VAT Number</label>
                                    <input type="text" class="form-control form-control-lg" id="profile-settings-vat" name="profile-settings-vat" value="IA00000000" disabled>
                                </div>
                            </div> -->
                            <div class="mb-4">
                                <button type="submit" class="btn btn-alt-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Billing Information -->
    </div>
    <!-- END Main Content -->
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
<script>
    var ajax_header = {
            "X-CSRF-TOKEN" : "{{ csrf_token() }}"
        }; //Token

    $('#update_user').on('submit', function(){
        event.preventDefault();
        var form = $(this)[0];
        var data = new FormData(form);
        $.ajaxSetup({
            headers: ajax_header
        });
        $.ajax({
            type: "POST",
            enctype: "multipart/form-data",
            url: "{{ route('profil.user') }}",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success: function (res) {
                var dataimg = res.data.foto
                var img_url = "{{ asset(':url') }}";
                img_url = img_url.replace(':url', dataimg);
                $('input[name="nama"]').val(res.data.nama);
                $('input[type="file"]').val();
                $('.img-avatar').attr('src', img_url);
                Swal.fire(
                    'Updated!',
                    'Data berhasil diubah.',
                    'success'
                )
            },
            error : function (res) {
                var errors = res.responseJSON;
                var message;
                if(errors.errors.email != null){
                    message = 'Email sudah terdaftar di karyawan lain';
                }else{
                    message = 'Error tidak diketahui';
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Errors',
                    text: message,
                });
            }
        });
    } )
    $('#update_password').on('submit', function(){
        event.preventDefault();
        var form = $(this)[0];
        var data = new FormData(form);
        $.ajaxSetup({
            headers: ajax_header
        });
        $.ajax({
            type: "POST",
            enctype: "multipart/form-data",
            url: "{{ route('profil.password') }}",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success: function (res) {
                $('input[type="password"]').val('');
                Swal.fire(
                    'Updated!',
                    'Data berhasil diubah.',
                    'success'
                )
            },
            error : function (res) {
                var errors = res.responseJSON;
                Swal.fire({
                    icon: 'error',
                    title: 'Errors',
                    text: 'Gagal mengubah data',
                });
            }
        });
    } )

    $('#update_informasi').on('submit', function(){
        event.preventDefault();
        var form = $(this)[0];
        var data = new FormData(form);
        $.ajaxSetup({
            headers: ajax_header
        });
        $.ajax({
            type: "POST",
            enctype: "multipart/form-data",
            url: "{{ route('profil.informasi') }}",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success: function (res) {
                Swal.fire(
                    'Updated!',
                    'Data berhasil diubah.',
                    'success'
                )
            },
            error : function (res) {
                var errors = res.responseJSON;
                var message;
                Swal.fire({
                    icon: 'error',
                    title: 'Errors',
                    text: 'Gagal mengubah data',
                });
            }
        });
    } )
</script>
@endsection
