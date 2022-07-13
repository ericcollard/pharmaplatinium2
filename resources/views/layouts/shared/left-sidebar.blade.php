<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- LOGO -->
    <a href="{{ route('home') }}" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{asset('assets/images/logo.png')}}" alt="" height="28">
        </span>
        <span class="logo-sm">
            <img src="{{asset('assets/images/logo_sm.png')}}" alt="" height="28">
        </span>
    </a>

    <!-- LOGO -->
    <a href="{{ route('home') }}" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="{{asset('assets/images/logo-dark.png')}}" alt="" height="28">
        </span>
        <span class="logo-sm">
            <img src="{{asset('assets/images/logo_sm_dark.png')}}" alt="" height="28">
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-item">
                <a href="{{ route('home') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span class="badge bg-success float-end">New</span>
                    <span> Tableau de bord </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarMesures" aria-expanded="false" aria-controls="sidebarMesures" class="side-nav-link collapsed">
                    <i class="uil uil-ruler"></i>
                    <span> MODELES </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarMesures" style="">
                    <ul class="side-nav-second-level">
                        <li >
                            <a href="{{ route('orderTemplate.draftOrderTemplates') }}">Mes brouillons</a>
                        </li>
                        <li >
                            <a href="{{ route('orderTemplate.openedOrderTemplates') }}">Mes modèles ouverts</a>
                        </li>
                        <li >
                            <a href="{{ route('orderTemplate.closedOrderTemplates') }}">Mes modèles fermés</a>
                        </li>
                        <li >
                            <a href="{{ route('orderTemplate.allOrderTemplates') }}">Tous</a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarAdmin1" aria-expanded="false" aria-controls="sidebarAdmin1" class="side-nav-link collapsed">
                    <i class="uil uil-cog"></i>
                    <span> COMMANDES </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarAdmin1" style="">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('order.openedOrders') }}">Commandes Ouvertes</a>
                        </li>
                        <li>
                            <a href="{{ route('order.closedOrders') }}">Commandes Fermées</a>
                        </li>
                        <li>
                            <a href="{{ route('order.index') }}">Toutes</a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarAdmin" aria-expanded="false" aria-controls="sidebarAdmin" class="side-nav-link collapsed">
                    <i class="uil uil-cog"></i>
                    <span> ADMINISTRATION </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarAdmin" style="">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('user.list') }}">Pharmacies</a>
                        </li>
                        <li>
                            <a href="{{ route('brand.list') }}">Laboratoires</a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>

        <!-- Help Box -->
        <div class="help-box text-white text-center">
            <a href="javascript: void(0);" class="float-end close-btn text-white">
                <i class="mdi mdi-close"></i>
            </a>
            <img src="{{asset('assets/images/help-icon.svg')}}" height="90" alt="Helper Icon Image" />
            <h5 class="mt-3">xxx</h5>
            <p class="mb-3">ksjhdqkjshdfkjhf</p>
            <a href="/posts/5/98" class="btn btn-outline-light btn-sm">Participer</a>
        </div>
        <!-- end Help Box -->
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
