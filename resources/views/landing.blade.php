<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.shared/head', ["page_title" => "Accueil"])
</head>


<body class="loading" data-layout-config='{"darkMode":false}'>

    <!-- NAVBAR START -->
    <nav class="navbar navbar-expand-lg py-lg-3 navbar-dark">
        <div class="container">

            <!-- logo -->
            <div  class="navbar-brand me-lg-5">
            <a href="{{ route('home') }}" class="logo logo-light" style="position: relative">
        <span class="logo-lg">
            <img src="{{asset('assets/images/logo.png')}}" alt="" height="28">
        </span>
                <span class="logo-sm">
            <img src="{{asset('assets/images/logo_sm.png')}}" alt="" height="28">
        </span>
            </a>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <i class="mdi mdi-menu"></i>
            </button>

            <!-- menus -->
            <div class="collapse navbar-collapse" id="navbarNavDropdown">

                <!-- right menu -->
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item me-2">
                        <a href="/login" class="btn btn-sm btn-success d-lg-inline-flex">Se connecter</a>
                    </li>
                    <li class="nav-item me-0">
                        <a href="/register" class="btn btn-sm btn-info d-lg-inline-flex">Créer un compte</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <!-- NAVBAR END -->

    <!-- START HERO -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <div class="mt-md-4">
                        <h2 class="text-white mb-4 mt-3 hero-title">
                            Pharmaplatinium : au service du GIE
                        </h2>

                        <p class="mb-4 font-16 text-white">Pharmaplatinium est un outil personnalisé de gestion des
                            commandes groupées pour les GIE pharmaceutiques.</p>

                        <a href="{{ route('login') }}" class="btn btn-success mt-2" style="margin-right: 1em">Se connecter <i class="mdi mdi-arrow-right ms-1"></i></a>
                        <a href="{{ route('register') }}" class="btn btn-info mt-2" style="margin-right: 1em">Créer un compte <i class="mdi mdi-arrow-right ms-1"></i></a>
                        <a href="{{ route('home') }}" class="btn btn-light mt-2">Juste visiter <i class="mdi mdi-arrow-right ms-1"></i></a>

                        <p class="mt-4 font-16 text-white"><em>Info. En tant que simple visiteur, les fonctionnalités et données visibles seront fortement
                                réduites. En vous connectant, vous aurez accès à l'essentiel des éléments. Créez gratuitement votre compte !</em></p>

                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="text-md-end mt-3 mt-md-0">
                        <img src="{{asset('assets/images/startup.jpg')}}" alt="" class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END HERO -->

    <!-- START PRESENTATION -->
    <section id="presentation" class="py-5">
        <div class="container">
            <div class="row py-4">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h1 class="mt-0"><i class="mdi mdi-infinity"></i></h1>
                        <h3>Pourquoi <span class="text-primary">Pharmaplatinium</span> est il <span class="text-primary">unique</span> ?</h3>
                        <p class="text-muted mt-2">Gérer des regroupements de commande avec des outils de bureautique (Excel, Word)
                            </br>et une communication par Email, Sms, Whatsapp ou autre devient vite ingérable. Pharmaplatinium offre
                        </br>une solution dédiée et professionnelle.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="text-center p-3">
                        <div class="avatar-sm m-auto">
                            <span class="avatar-title bg-primary-lighten rounded-circle">
                                <i class="uil  uil-database-alt text-primary font-24"></i>
                            </span>
                        </div>
                        <h4 class="mt-3">Ordonner</h4>
                        <p class="text-muted mt-2 mb-0">Pour grouper des commandes efficacement, il est primmordial
                            d'exposer clairement des données, et de les ordonner pour permettre à tous de
                            faire ses commandes en toute confiance
                        </p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="text-center p-3">
                        <div class="avatar-sm m-auto">
                            <span class="avatar-title bg-primary-lighten rounded-circle">
                                <i class="uil uil-link-broken text-primary font-24"></i>
                            </span>
                        </div>
                        <h4 class="mt-3">Unifier</h4>
                        <p class="text-muted mt-2 mb-0">Le groupage de commande est basé sur la communication entre les acteurs. Pour éviter d'avoir à surveiller
                            10 canaux de communication (tel, mail, sms, whatsapp, messenger etc.), optez pour un unique canal dédié
                        </p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="text-center p-3">
                        <div class="avatar-sm m-auto">
                            <span class="avatar-title bg-primary-lighten rounded-circle">
                                <i class="uil uil-users-alt text-primary font-24"></i>
                            </span>
                        </div>
                        <h4 class="mt-3">Orchestrer</h4>
                        <p class="text-muted mt-2 mb-0">La clé d'un processus de groupage de commande est le timing pour que
                            tous les acteurs agissent de concert. Pharmaplatinium guide et donne la mesure pour plus d'efficacité
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="text-center p-3">
                        <div class="avatar-sm m-auto">
                            <span class="avatar-title bg-primary-lighten rounded-circle">
                                <i class="uil uil-sync text-primary font-24"></i>
                            </span>
                        </div>
                        <h4 class="mt-3">Archiver</h4>
                        <p class="text-muted mt-2 mb-0">Pour ne rien perdre, pour ne rien chercher, mais surtout pour offrir
                            un service fiable à 100%, Pharmaplatinium archive toutes les données de commande
                        </p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="text-center p-3">
                        <div class="avatar-sm m-auto">
                            <span class="avatar-title bg-primary-lighten rounded-circle">
                                <i class="uil uil-chart-growth text-primary font-24"></i>
                            </span>
                        </div>
                        <h4 class="mt-3">Exploiter</h4>
                        <p class="text-muted mt-2 mb-0">Commander est une chose, livrer les commandes est aussi important.
                            Pharmaplatinium propose des états pour faciliter le dispatch, et les échanges avec les fournisseurs
                        </p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="text-center p-3">
                        <div class="avatar-sm m-auto">
                            <span class="avatar-title bg-primary-lighten rounded-circle">
                                <i class="uil uil-graduation-hat text-primary font-24"></i>
                            </span>
                        </div>
                        <h4 class="mt-3">Gagner du temps</h4>
                        <p class="text-muted mt-2 mb-0">Toutes ces fonctionnalités non qu'un seul but: faire gagner du temps et de
                            l'énergie aux gestionnaires, tout en offrant un niveau de fiabilité maximum.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- END PRESENTATION -->






    <!-- START FOOTER -->
    <footer id="foot" class="bg-dark py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <img src="{{asset('assets/images/logo.png')}}" alt="" class="logo-dark" height="18" />

                </div>
                <div class="col-lg-6 text-end">
                    <p class="text-muted">© 2022 Pharmaplatinium. Powered by Glissattitude</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- END FOOTER -->

    <!-- bundle -->
    @include('layouts.shared/footer-script')

</body>

</html>
