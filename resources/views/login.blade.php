<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <title>CMS - Absensi & Laporan Pekerjaan</title>

    <meta name="description" content="CMS - Absensi & Laporan Pekerjaan">
    <meta name="author" content="solusiciptamedia">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="CMS - Absensi & Laporan Pekerjaan">
    <meta property="og:site_name" content="solusiciptamedia">
    <meta property="og:description" content="CMS - Absensi & Laporan Pekerjaan">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{{ asset('media/favicons/cms.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('media/favicons/cms.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/cms.png') }}">
    <!-- END Icons -->

    <!-- Stylesheets -->

    <!-- Fonts and Codebase framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ asset('css/codebase.min.css') }}">

</head>

<body>
    
    <div id="page-container" class="main-content-boxed">

        <!-- Main Container -->
        <main id="main-container">
            <!-- Page Content -->
            <div class="bg-image" style="background-image: url('{{ asset('media/photos/cmsoffice.png') }}');">
                <div class="row mx-0 bg-black-50">
                    <div class="hero-static col-md-6 col-xl-8 d-none d-md-flex align-items-md-end">
                        <div class="p-4">
                            <p class="fs-3 fw-semibold text-white">
                                CV. Cipta Multi Solution
                            </p>
                            <p class="text-white-75 fw-medium">
                                Copyright &copy; <span data-toggle="year-copy"></span>
                            </p>
                        </div>
                    </div>
                    <div class="hero-static col-md-6 col-xl-4 d-flex align-items-center bg-body-extra-light">
                        <div class="content content-full">
                            <!-- Header -->
                            <div class="px-4 py-2 mb-4">
                                <a class="link-fx fw-bold" href="index.html">
                                    <img src="{{ asset('media/favicons/cms.png') }}" alt="cms" width="50%">
                                </a>
                                <h1 class="h3 fw-bold mt-4 mb-2">Absensi & Laporan Pekerjaan</h1>
                                <h2 class="h5 fw-medium text-muted mb-0">Please sign in</h2>
                                @if ( isset($error))
                                    <h2 class="h5 fw-medium text-muted mb-0">Please sign in</h2>
                                @endif
                            </div>
                            <!-- END Header -->

                            <!-- Sign In Form -->
                            <!-- jQuery Validation functionality is initialized with .js-validation-signin class in js/pages/op_auth_signin.min.js which was auto compiled from _js/pages/op_auth_signin.js -->
                            <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                @if (Session::has('errorLogin'))
                                    <span style="color: rgb(218, 54, 54) " class="ms-2">Email atau Password salah</span>
                                @endif
                                <div class="form-floating mb-4">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your username" autofocus value="{{ old('email') }}">
                                    <label class="form-label" for="email">Email</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                <div class="mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                        <label class="form-check-label" for="remember">Remember Me</label>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-lg btn-alt-primary fw-semibold">
                                        Sign In
                                    </button>
                                    
                                </div>
                            </form>
                            <!-- END Sign In Form -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Page Content -->
        </main>
        <!-- END Main Container -->
    </div>
    <!-- END Page Container -->
    
    <!--
        Codebase JS

        Core libraries and functionality
        webpack is putting everything together at assets/_js/main/app.js
    -->
    <script src="{{ asset('js/codebase.app.min.js') }}"></script>

    <!-- jQuery (required for Select2 + jQuery Validation plugins) -->
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/op_auth_signin.min.js') }}"></script>
</body>

</html>