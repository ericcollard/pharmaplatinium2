@extends('layouts.vertical', ["page_title"=> "Laboratoire"])

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
                            <li class="breadcrumb-item"><a href="{{ route('brand.list') }}">Laboratoires</a></li>
                            <li class="breadcrumb-item"><a href="#">{{ $brand->name }}</a></li>
                            <li class="breadcrumb-item active">Fiche de laboratoire</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Laboratoire {{ $brand->name }}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-sm-12">
                <!-- Profile -->
                <div class="card ">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="header-title mt-0 mb-3">Gestionnaire :
                                    @if ($brand->manager)
                                        <a href="{{ $brand->manager->path() }}">{{ $brand->manager->name }}</a>
                                    @else
                                        nc.
                                    @endif
                                </h4>
                            </div> <!-- end col-->

                            <div class="col-sm-6">


                                <div class="text-center mt-sm-0 mt-3 text-sm-end">

                                    @can ('delete', $brand)
                                        <form class="d-sm-inline-block" method="POST" action="{{ route('brand.destroy',['brand' => $brand]) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger"> {{ __('Delete') }}</button>
                                        </form>
                                    @endcan

                                    @can ('update', $brand)
                                    <button type="button" class="btn btn-warning m-lg-2">
                                        <a href="{{ route('brand.edit' , ['brand' => $brand]) }}" style="color: inherit">
                                            <i class="mdi mdi-account-edit me-1"></i> Mise à jour
                                        </a>
                                    </button>
                                    @endcan

                                </div>
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
                        <h4 class="header-title mt-0 mb-3">Contact</h4>

                        <div class="text-start">
                            <p class="text-muted"><strong>Nom :</strong> <span class="ms-2">{{ $brand->contact_name ?: 'nc'  }}</span></p>
                            <p class="text-muted"><strong>Téléphone:</strong> <span class="ms-2">{{ $brand->contact_phone ?: 'nc'  }}</span></p>
                            <p class="text-muted"><strong>Email:</strong> <span class="ms-2">{{ $brand->contact_email ?: 'nc'  }}</span></p>
                        </div>
                    </div>
                </div>
                <!-- Personal-Information -->

                <div class="card text-white bg-info overflow-hidden">
                    <div class="card-body">
                        <div class="toll-free-box text-center">
                            <h4> <i class="mdi mdi-deskphone"></i> Remise standard : {{ !is_null($brand->discount)  ? number_format($brand->discount*100.0,2).' %'  : 'nc' }}</h4>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->


            </div> <!-- end col-->

            <div class="col-xl-8">

                @if ($brand->comment)
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">Commentaire</h4>
                        <div class="text-muted">
                            {!! $brand->comment ?: 'nc' !!}
                        </div>
                    </div>
                </div>
                @endif

                <!-- Chart-->
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">Modèles de commande gérés</h4>
                    </div>
                </div>
                <!-- End Chart-->

            </div>
            <!-- end col -->

        </div>
        <!-- end row -->

    </div> <!-- container -->
@endsection

