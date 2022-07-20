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
                        <h4 class="header-title mb-3">Modèles de commande sur un an glissant</h4>
                        <P>Date de cloture entre le {{ now()->sub(new DateInterval('P1Y'))->formatLocalized('%d %B %Y') }} et ce jour.</P>

                        @if ($brand->ordertemplates->count() > 0)
                            <div class="table-responsive-xl">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Ref</th>
                                        <th scope="col">Date de crétion</th>
                                        <th scope="col">Date de cloture</th>
                                        <th scope="col">Titre</th>
                                        <th scope="col">Statut</th>
                                        <th scope="col">Montant</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $totalValue = 0.0;
                                    ?>



                                    @foreach($brand->ordertemplates()->where('dead_line','>=',now()->sub(new DateInterval('P1Y')))->get() as $index => $orderTemplate)

                                        <?php
                                            $orderValue = $orderTemplate->totalValue();
                                            $totalValue += $orderValue;
                                        ?>
                                        <tr>
                                            <th scope="row">{{ $orderTemplate->id }}</th>
                                            <td>{{ $orderTemplate->created_at->formatLocalized('%d %B %Y') }}</td>
                                            <td>{{ $orderTemplate->dead_line->formatLocalized('%d %B %Y') }}</td>
                                            <td>{{ $orderTemplate->title }}</td>
                                            <td>{{ $orderTemplate->status }}</td>
                                            <td>{{ number_format($orderValue,2).'€' }}</td>

                                            <td class="table-action">
                                                <a href="{{ route('orderTemplate.show',$orderTemplate) }}" class="action-icon"> <i class="mdi mdi-magnify"></i></a>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <p>Total : {{ number_format($totalValue,2).'€' }}</p>
                            </div>
                        @endif


                    </div>
                </div>
                <!-- End Chart-->

            </div>
            <!-- end col -->

        </div>
        <!-- end row -->

    </div> <!-- container -->
@endsection

