<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Admin Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets')}}/images/favicon.ico">

    <!-- preloader css -->
    <link rel="stylesheet" href="{{ asset('backend/assets')}}/css/preloader.min.css" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('backend/assets')}}/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('backend/assets')}}/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('backend/assets')}}/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>

<!-- <body data-layout="horizontal"> -->
<div class="auth-page">
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-xxl-3 col-lg-4 col-md-5">
                <div class="auth-full-page-content d-flex p-sm-5 p-4">
                    <div class="w-100">
                        <div class="d-flex flex-column h-100">
                            <div class="mb-4 mb-md-5 text-center">
                                <a href="{{ route('admin.password.reset') }}" class="d-block auth-logo">
                                    <img src="{{ asset('backend/assets')}}/images/logo-sm.svg" alt="" height="28"> <span class="logo-txt">Admin</span>
                                </a>
                            </div>
                            <div class="auth-content my-auto">
                                <div class="text-center">
                                    <h5 class="mb-3">Reset Password</h5>
                                </div>

                                <form class="mt-4 pt-2" action="{{ route('admin.password.store') }}" method="post">
                                    @csrf

                                    <!-- Password Reset Token -->
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">


                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" value="{{old('email', $request->email)}}" class="form-control" id="email" placeholder="Enter email">
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">New Password</label>
                                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter password">
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Confirm New Password</label>
                                        <input type="password" name="password-confirmation" class="form-control" id="password-confirmation" placeholder="Enter password-confirmation">
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>

                                    <div class="mb-3">
                                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Reset Password</button>
                                    </div>
                                </form>

                            </div>
                            <div class="mt-4 mt-md-5 text-center">
                                <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> Mohamed Magdy</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end auth full page content -->
            </div>
            <!-- end col -->
            <div class="col-xxl-9 col-lg-8 col-md-7">
                <div class="auth-bg pt-md-5 p-4 d-flex">
                    <div class="bg-overlay bg-primary"></div>
                    <ul class="bg-bubbles">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <!-- end bubble effect -->
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container fluid -->
</div>


<!-- JAVASCRIPT -->
<script src="{{ asset('backend/assets')}}/libs/jquery/jquery.min.js"></script>
<script src="{{ asset('backend/assets')}}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('backend/assets')}}/libs/metismenu/metisMenu.min.js"></script>
<script src="{{ asset('backend/assets')}}/libs/simplebar/simplebar.min.js"></script>
<script src="{{ asset('backend/assets')}}/libs/node-waves/waves.min.js"></script>
<script src="{{ asset('backend/assets')}}/libs/feather-icons/feather.min.js"></script>
<!-- pace js -->
<script src="{{ asset('backend/assets')}}/libs/pace-js/pace.min.js"></script>
<!-- password addon init -->
<script src="{{ asset('backend/assets')}}/js/pages/pass-addon.init.js"></script>

</body>

</html>
