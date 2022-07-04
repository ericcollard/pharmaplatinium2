<!DOCTYPE html>
<html lang="en">

<head>

    @include('layouts.shared/head', ["page_title"=> "Log In"] )

</head>

<body class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5">
                    <div class="card">

                        <!-- Logo -->
                        <div class="card-header pt-4 pb-4 text-center bg-primary">
                            <a href="{{ route('home') }}">
                                <span><img src="{{asset('assets/images/logo.png')}}" alt="" height="18"></span>
                            </a>
                        </div>

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <h4 class="text-dark-50 text-center mt-0 fw-bold">{{ __('auth.Sign In') }}</h4>
                                <p class="text-muted mb-4">{{ __('auth.Enter your email address and password to access private zone.') }}</p>
                            </div>

                            @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>
                            <br>@endif
                            @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>
                            <br>@endif

                            @if (sizeof($errors) > 0)
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li class="text-danger">{{ $error }}</li>
                                @endforeach
                            </ul>
                            @endif



                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="emailaddress" class="form-label">{{ __('auth.E-Mail Address') }}</label>
                                    <input class="form-control" type="email" name="email" id="emailaddress" placeholder="{{ __('auth.Enter your email') }}">
                                </div>

                                <div class="mb-3">
                                    <a href="{{route('password.request')}}" class="text-muted float-end"><small>{{ __('auth.Forgot your password') }} ?</small></a>
                                    <label for="password" class="form-label">{{ __('auth.Password') }}</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" name="password" class="form-control" placeholder="{{ __('auth.Enter your password') }}">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" name="remember" class="form-check-input" id="checkbox-signin" checked>
                                        <label class="form-check-label" for="checkbox-signin">{{ __('auth.Remember Me') }}</label>
                                    </div>
                                </div>

                                <div class="mb-3 mb-0 text-center">
                                    <button class="btn btn-primary" type="submit">{{ __('auth.Log In') }}</button>
                                </div>

                            </form>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="text-muted">{{ __("auth.Don't have an account") }} ? <a href="{{ route('register') }}" class="text-muted ms-1"><b>{{ __('auth.Register') }}</b></a></p>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    @include('layouts.shared/footer-3')

    @include('layouts.shared/footer-script')

</body>

</html>
