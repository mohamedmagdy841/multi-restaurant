<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Vendor Forget Password</title>
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
                                <a href="{{ route('vendor.password.request') }}" class="d-block auth-logo">
                                    <img src="{{ asset('backend/assets')}}/images/logo-sm.svg" alt="" height="28"> <span class="logo-txt">Vendor</span>
                                </a>
                            </div>
                            <div class="auth-content my-auto">
                                <div class="text-center">
                                    <h5 class="mb-3">Forgot Password</h5>
                                </div>

                                <!-- Session Status -->
                                <x-auth-session-status class="mb-4" :status="session('status')" />

                                <form class="mt-4 pt-2" action="{{ route('vendor.password.email') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email" placeholder="Enter email">
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        <div class="mt-3">
                                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Email Password Reset Link</button>
                                        </div>
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

{{--<x-guest-layout>--}}
{{--    <div class="mb-4 text-sm text-gray-600">--}}
{{--        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}--}}
{{--    </div>--}}

{{--    <!-- Session Status -->--}}
{{--    <x-auth-session-status class="mb-4" :status="session('status')" />--}}

{{--    <form method="POST" action="{{ route('admin.password.email') }}">--}}
{{--        @csrf--}}

{{--        <!-- Email Address -->--}}
{{--        <div>--}}
{{--            <x-input-label for="email" :value="__('Email')" />--}}
{{--            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />--}}
{{--            <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            <x-primary-button>--}}
{{--                {{ __('Email Password Reset Link') }}--}}
{{--            </x-primary-button>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--</x-guest-layout>--}}

