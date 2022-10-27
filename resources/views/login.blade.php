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
    <!-- <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}"> -->
    <!-- END Icons -->

    <!-- Stylesheets -->

    <!-- Fonts and Codebase framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ asset('css/codebase.min.css') }}">

    <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
    <!-- <link rel="stylesheet" id="css-theme" href="{{ asset('css/themes/flat.min.css') }}"> -->
    <!-- END Stylesheets -->
</head>

<body>
    <!-- Page Container -->
    <!--
      Available classes for #page-container:

      GENERIC

        'remember-theme'                            Remembers active color theme and dark mode between pages using localStorage when set through
                                                    - Theme helper buttons [data-toggle="theme"],
                                                    - Layout helper buttons [data-toggle="layout" data-action="dark_mode_[on/off/toggle]"]
                                                    - ..and/or Codebase.layout('dark_mode_[on/off/toggle]')

      SIDEBAR & SIDE OVERLAY

        'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
        'sidebar-mini'                              Mini hoverable Sidebar (screen width > 991px)
        'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
        'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
        'sidebar-dark'                              Dark themed sidebar

        'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
        'side-overlay-o'                            Visible Side Overlay by default

        'enable-page-overlay'                       Enables a visible clickable Page Overlay (closes Side Overlay on click) when Side Overlay opens

        'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

      HEADER

        ''                                          Static Header if no class is added
        'page-header-fixed'                         Fixed Header

      HEADER STYLE

        ''                                          Classic Header style if no class is added
        'page-header-modern'                        Modern Header style
        'page-header-dark'                          Dark themed Header (works only with classic Header style)
        'page-header-glass'                         Light themed Header with transparency by default
                                                    (absolute position, perfect for light images underneath - solid light background on scroll if the Header is also set as fixed)
        'page-header-glass page-header-dark'        Dark themed Header with transparency by default
                                                    (absolute position, perfect for dark images underneath - solid dark background on scroll if the Header is also set as fixed)

      MAIN CONTENT LAYOUT

        ''                                          Full width Main Content if no class is added
        'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
        'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)

      DARK MODE

        'sidebar-dark page-header-dark dark-mode'   Enable dark mode (light sidebar/header is not supported with dark mode)
    -->
    <div id="page-container" class="main-content-boxed">

        <!-- Main Container -->
        <main id="main-container">
            <!-- Page Content -->
            <div class="bg-image" style="background-image: url('{{ asset('media/photos/cmsoffice.png') }}');">
                <!-- <div class="bg-image" style="background-image: url('{{ asset('media/photos/photo41@2x.jpg') }}');"> -->
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
                                    <!-- <i class="fa fa-fire"></i> -->
                                    <img src="{{ asset('media/favicons/cms.png') }}" alt="cms" width="50%">
                                    <!-- <span class="fs-4 text-body-color">code</span><span class="fs-4">base</span> -->
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
                                    <!-- <div class="mt-4">
                                        <a class="fs-sm fw-medium link-fx text-muted me-2 mb-1 d-inline-block" href="op_auth_signup2.html">
                                            Create Account
                                        </a>
                                        <a class="fs-sm fw-medium link-fx text-muted me-2 mb-1 d-inline-block" href="op_auth_reminder2.html">
                                            Forgot Password
                                        </a>
                                    </div> -->
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