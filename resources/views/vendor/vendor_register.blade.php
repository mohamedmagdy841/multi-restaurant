<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Vendor Register</title>
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

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

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
                                <a href="index.html" class="d-block auth-logo">
                                    <img src="{{ asset('backend/assets')}}/images/logo-sm.svg" alt="" height="28"> <span class="logo-txt">Vendor</span>
                                </a>
                            </div>
                            <div class="auth-content my-auto">
                                <div class="text-center">
                                    <h5 class="mb-0">Register Account</h5>
                                    <p class="text-muted mt-2">Get your free account now.</p>
                                </div>
                                @if($errors->any())
                                    @foreach($errors->all() as $error)
                                        <li class="text-danger">{{ $error }}</li>
                                    @endforeach
                                @endif

                                @if(Session::has('error'))
                                    <li class="text-danger">{{ Session::get('error') }}</li>
                                @endif

                                @if(Session::has('success'))
                                    <li>{{ Session::get('success') }}</li>
                                @endif
                                <form class="mt-4 pt-2" action="{{ route('vendor.register_submit') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Restaurant Name</label>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter username">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Phone</label>
                                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Phone">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Address</label>
                                        <input type="text" name="address" class="form-control" id="address" placeholder="Enter Address">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                                    </div>
                                    <div class="mb-3">
                                        <div class="d-flex align-items-start">
                                            <div class="flex-grow-1">
                                                <label class="form-label">Password</label>
                                            </div>
                                        </div>

                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" name="password" class="form-control" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon">
                                            <button class="btn btn-light shadow-none ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <p class="mb-0">By registering you agree to the <a href="#" class="text-primary">Terms of Use</a></p>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Register</button>
                                    </div>
                                </form>

                                <div class="mt-4 pt-2 text-center">
                                    <div class="signin-other-title">
                                        <h5 class="font-size-14 mb-3 text-muted fw-medium">- Sign up using -</h5>
                                    </div>

                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="javascript:void()"
                                               class="social-list-item bg-primary text-white border-primary">
                                                <i class="mdi mdi-facebook"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript:void()"
                                               class="social-list-item bg-info text-white border-info">
                                                <i class="mdi mdi-twitter"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript:void()"
                                               class="social-list-item bg-danger text-white border-danger">
                                                <i class="mdi mdi-google"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="mt-5 text-center">
                                    <p class="text-muted mb-0">Already have an account ? <a href="{{ route('vendor.login') }}"
                                                                                            class="text-primary fw-semibold"> Login </a> </p>
                                </div>
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

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type','info') }}"
    switch(type){
        case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;

        case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;

        case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;

        case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
    }
    @endif
</script>

</body>

</html>
