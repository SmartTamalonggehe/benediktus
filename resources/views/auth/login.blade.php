<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> Login | Fakultas Sains & Teknologi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Fakultas Sains & Teknologi" name="description" />
    <meta content="King Pro P4W" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assetsAdmin/images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assetsAdmin/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assetsAdmin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assetsAdmin/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>
    <div class="home-btn d-none d-sm-block">
        <a href="{{ url('/') }}" class="text-dark"><i class="fas fa-home h2"></i></a>
    </div>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-login text-center">
                            <div class="bg-login-overlay"></div>
                            <div class="position-relative">
                                <h5 class="text-white font-size-20">Selamat Datang !</h5>
                                <p class="text-white-50 mb-0">Silahkan Login</p>
                                <a href="" class="logo logo-admin mt-4">
                                    <img src="{{ asset('logo-icon.png') }}" alt="" height="60">
                                </a>
                            </div>
                        </div>
                        <div class="card-body pt-5">
                            <div class="p-2">
                                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                                    </div>
                                    @error('username')
                                    <span class="alert-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    <div class="form-group">
                                        <label for="userpassword">Password</label>
                                        <input type="password" class="form-control" id="userpassword" name="password" placeholder="Enter password">
                                    </div>
                                    @error('password')
                                        <span class="alert-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customControlInline" name="remember">
                                        <label class="custom-control-label" for="customControlInline">Ingat Saya</label>
                                    </div>

                                    <div class="mt-3">
                                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assetsAdmin/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assetsAdmin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assetsAdmin/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assetsAdmin/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assetsAdmin/libs/node-waves/waves.min.js') }}"></script>


    <script src="{{ asset('assetsAdmin/js/app.js') }}"></script>


</body>

</html>
