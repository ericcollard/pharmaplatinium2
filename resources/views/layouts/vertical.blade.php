<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.shared/head', ["page_title"=> $page_title] )
</head>

<body class="loading" data-layout-config='{"leftSideBarTheme":"default","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": false}'>
    @yield('preloader')
    <!-- Begin page -->
    <div class="wrapper">
        @include('layouts.shared/left-sidebar')

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                @include('layouts.shared/topbar')


                @if(Session::has('message'))
                    <div class="alert alert-{{ Session::get('alert', 'success') }} alert-dismissible fade show mt-2" role="alert">
                        <strong>{{ __(Session::get('alert', 'success')) }} !</strong> {{ Session::get('message', '') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')

            </div>
            <!-- content -->

            @include('layouts.shared/footer')

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    @include('layouts.shared/right-sidebar')

    @include('layouts.shared/footer-script')

</body>

</html>
