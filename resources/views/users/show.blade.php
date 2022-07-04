@extends('layouts.vertical', ["page_title"=> "Profile"])

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">

                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ config('app.name') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('user.list') }}">Pharmacies</a></li>
                            <li class="breadcrumb-item"><a href="#">{{ $user->name }}</a></li>
                            <li class="breadcrumb-item active">Fiche de profil</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Fiche de pharmacie</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-sm-12">
                <!-- Profile -->
                <div class="card bg-primary">
                    <div class="card-body profile-user-box">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar-lg">
                                            <img src="{{ $user->avatarUrl() }}" alt="" class="rounded-circle img-thumbnail" />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div>
                                            <h4 class="mt-1 mb-1 text-white">Pharmacie {{ $user->name }}</h4>
                                            @can('see-admin-only-data')
                                            <p class="font-13 text-white-50">Rôles :
                                                @foreach  ($user->roles as $role)
                                                    {{ $role }}
                                                @endforeach
                                            </p>
                                            @endcan

                                            <ul class="mb-0 list-inline text-light">
                                                <li class="list-inline-item me-3">
                                                    <h5 class="mb-1">{{ $user->adress ?: 'nc'  }}</h5>
                                                    <p class="mb-0 font-13 text-white-50">{{ __('Adress') }}</p>
                                                </li>
                                                <li class="list-inline-item me-3">
                                                    <h5 class="mb-1">{{ $user->postal_code ?: 'nc'  }}</h5>
                                                    <p class="mb-0 font-13 text-white-50">{{ __('Postal code') }}</p>
                                                </li>
                                                <li class="list-inline-item">
                                                    <h5 class="mb-1">{{ $user->city ?: 'nc'  }}</h5>
                                                    <p class="mb-0 font-13 text-white-50">{{ __('City') }}</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col-sm-6">


                                <div class="text-center mt-sm-0 mt-3 text-sm-end">

                                    @can ('delete', $user)
                                        <form class="d-sm-inline-block" method="POST" action="{{ route('user.destroy',['user' => $user]) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger"> {{ __('Delete') }}</button>
                                        </form>
                                    @endcan

                                    @can ('update', $user)
                                    <button type="button" class="btn btn-warning m-lg-2">
                                        <a href="{{ route('user.edit' , ['user' => $user]) }}" style="color: inherit">
                                            <i class="mdi mdi-account-edit me-1"></i> {{ __('Edit profile') }}
                                        </a>
                                    </button>
                                    @endcan

                                </div>

                                @can ('update', $user)
                                <div class="text-center mt-sm-3 mt-3 text-sm-end">

                                    <form method="POST"
                                           action="{{  route('user.avatar.store',['user' => $user]) }}"
                                           enctype="multipart/form-data">
                                        {{ csrf_field() }}

                                        <div class="mb-3 row-cols-lg-auto g-3 align-items-center">
                                            <input type="file" id="avatar" name="avatar" class="form-control" style="display: inline; width: auto">
                                            <input type="hidden" id="user_id" name="user_id" value={{ $user->id }}>
                                            <button class="btn btn-light  m-lg-2" type="submit"><i class="mdi mdi-upload me-1"></i>
                                                @if ($user->avatar_path)
                                                    {{ __('Modify avatar') }}
                                                @else
                                                    {{ __('Add avatar') }}
                                                @endif
                                            </button>
                                        </div>


                                        @if (count($errors))
                                            <ul class="alert alert-danger">
                                                @foreach($errors->all() as $error)
                                                    <li><i class="fas fa-exclamation-triangle"></i> {{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </form>


                                </div>
                                @endcan

                            </div> <!-- end col-->
                        </div> <!-- end row -->

                    </div> <!-- end card-body/ profile-user-box-->
                </div>
                <!--end profile/ card -->
            </div> <!-- end col-->
        </div>
        <!-- end row -->


        <div class="row">
            <div class="col-xl-4">
                <!-- Personal-Information -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mt-0 mb-3">Informations complémentaires</h4>
                        <p class="text-muted font-13"><strong>{{ __('Commentaire') }}</strong> :</p>
                        <div class="text-muted">
                            {!! $user->comment ?: 'nc' !!}
                        </div>
                        <hr />

                        <div class="text-start">
                            <p class="text-muted"><strong>Téléphone :</strong> <span class="ms-2">{{ $user->phone ?: 'nc'  }}</span></p>

                            <p class="text-muted"><strong>Dernière connexion :</strong> <span class="ms-2">
                                    {{ $user->last_login->format('d/m/Y') ?: 'nc'  }}
                                </span></p>

                        </div>

                        <hr />

                        <div class="text-start">
                            <p class="text-muted">
                                <strong>Liste des labos en gestion :</strong>
                            </p>

                            @foreach($user->brands as $brand)
                            <span class="ms-2 text-muted">
                                <a href="{{ $brand->path() }}">{{ $brand->name }}</a>
                            </span>
                            @endforeach


                        </div>
                    </div>
                </div>
                <!-- Personal-Information -->

                <!-- Email-->
                @can('see-userprofile-private-data',$user)
                    <div class="card text-white bg-info overflow-hidden">
                        <div class="card-body">
                            <div class="toll-free-box text-center">
                                <h4> <i class="mdi mdi-deskphone"></i> Email : {{ $user->email  ?: 'nc' }}</h4>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                @endcan
                <!-- End Email-->

            </div> <!-- end col-->

            <div class="col-xl-8">

                <!-- Chart-->
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">Modèles de commande gérés</h4>
                    </div>
                </div>
                <!-- End Chart-->

                <div class="row">
                    <div class="col-sm-4">
                        <div class="card tilebox-one">
                            <div class="card-body">

                            </div> <!-- end card-body-->
                        </div>
                        <!--end card-->
                    </div><!-- end col -->

                    <div class="col-sm-4">
                        <div class="card tilebox-one">
                            <div class="card-body">

                            </div> <!-- end card-body-->
                        </div>
                        <!--end card-->
                    </div><!-- end col -->

                    <div class="col-sm-4">
                        <div class="card tilebox-one">
                            <div class="card-body">

                            </div> <!-- end card-body-->
                        </div>
                        <!--end card-->
                    </div><!-- end col -->

                </div>
                <!-- end row -->


                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">Mes commandes</h4>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->

            </div>
            <!-- end col -->

        </div>
        <!-- end row -->

    </div> <!-- container -->
@endsection

