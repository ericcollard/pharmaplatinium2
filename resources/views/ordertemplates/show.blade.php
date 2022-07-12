@extends('layouts.vertical', ["page_title"=> "Modèle de commande"])

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
                            <li class="breadcrumb-item"><a href="{{ route('orderTemplate.list') }}">Modèle de commande</a></li>
                            <li class="breadcrumb-item">{{ $orderTemplate->brand->name }} ref {{ $orderTemplate->id }}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Modèle de commande : {{ $orderTemplate->brand->name }} du {{ $orderTemplate->created_at->formatLocalized('%d %B %Y') }}</h4>
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
                                <div class="mb-1"><span class="header-title">Gestionnaire : </span> <span class="text-muted">Pharmacie {{ $orderTemplate->brand->manager->name }}</span></div>
                                <div class="mb-1"><span class="header-title">Date de cloture : </span> <span class="text-muted">{{ $orderTemplate->dead_line->formatLocalized('%d %B %Y') }}</span></div>

                            </div> <!-- end col-->

                            <div class="col-sm-6">


                                <div class="text-center mt-sm-0 mt-3 text-sm-end">

                                    @can ('delete', $orderTemplate)
                                        <form class="d-sm-inline-block" method="POST" action="{{ route('orderTemplate.destroy',['orderTemplate' => $orderTemplate]) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger"> {{ __('Delete') }}</button>
                                        </form>
                                    @endcan

                                    @can ('update', $orderTemplate)
                                    <button type="button" class="btn btn-warning m-lg-2">
                                        <a href="{{ route('orderTemplate.edit' , ['orderTemplate' => $orderTemplate]) }}" style="color: inherit">
                                            <i class="mdi mdi-account-edit me-1"></i> Mise à jour
                                        </a>
                                    </button>
                                    @endcan

                                </div>
                            </div> <!-- end col-->
                        </div> <!-- end row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="header-title">Commentaire</div>
                                <div class="text-muted  mb-1">
                                    {!! $orderTemplate->comment ?: 'nc' !!}
                                </div>
                            </div> <!-- end col-->

                            <div class="col-sm-6">
                                <div class="mb-1"><span class="header-title">Titre : </span> <span class="text-muted">{{ $orderTemplate->title }}</span></div>
                                <div class="mb-1"><span class="header-title">Montant de la commande : </span> <span {!! $orderTemplate->totalValue() >=  $orderTemplate->franco ? 'style="color : green"' : 'style="color : red"' !!}>{{ number_format($orderTemplate->totalValue(),2).'€' }}</span></div>
                                <div class="mb-1"><span class="header-title">Valeur du franco : </span> <span class="text-muted">{{ !is_null($orderTemplate->franco) ? number_format($orderTemplate->franco,2).'€'  : 'nc' }}</span></div>
                                <div class="mb-1"><span class="header-title">Statut : </span> <span class="text-muted">{{ $orderTemplate->status }}</span></div>

                            </div> <!-- end col-->
                        </div> <!-- end row -->

                    </div> <!-- end card-body/ profile-user-box-->
                </div>
                <!--end profile/ card -->
            </div> <!-- end col-->
        </div>
        <!-- end row -->


        <div class="row">
            <div class="col-sm-12">
                <!-- Profile -->
                <div class="card ">
                    <div class="card-body ">


                        <div class="row">
                            <div class="col-12 text-sm-end">
                                <button type="button" class="btn btn-success m-lg-2">
                                    <a href="{{ route('orderTemplateContent.create' , ['orderTemplate' => $orderTemplate]) }}" style="color: inherit">
                                        <i class="mdi mdi-account-edit me-1"></i> Ajouter une ligne
                                    </a>
                                </button>
                            </div>
                        </div>


                        @if ($orderTemplate->content->count() > 0)
                            <div class="table-responsive-xl">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">EAN</th>
                                    <th scope="col">Produit</th>
                                    <th scope="col">Variante</th>
                                    <th scope="col">Prix</th>
                                    <th scope="col">Prix palier</th>
                                    <th scope="col">Palier</th>
                                    <th scope="col">Colisage</th>
                                    <th scope="col">Qté totale</th>
                                    <th scope="col">Sous total</th>
                                    <th scope="col">Comment</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($orderTemplate->content as $index => $orderTemplateContentItem)
                                        <?php
                                            $totalQty = $orderTemplateContentItem->totalQty();
                                        ?>
                                    <tr>
                                        <th scope="row">{{ $orderTemplateContentItem->ean }}</th>
                                        <td>{{ $orderTemplateContentItem->name }}</td>
                                        <td>{{ $orderTemplateContentItem->variant }}</td>
                                        <td {!! $totalQty <  $orderTemplateContentItem->step_value ? 'style="color : red; font-weight: bold"' : 'style="text-decoration: line-through"' !!}  >{{ !is_null($orderTemplateContentItem->price) ? number_format($orderTemplateContentItem->price,2).'€'  : 'nc' }}</td>
                                        <td {!! $totalQty >=  $orderTemplateContentItem->step_value ? 'style="color : green; font-weight: bold"' : 'style="text-decoration: line-through"' !!}  >{{ !is_null($orderTemplateContentItem->step_price) ? number_format($orderTemplateContentItem->step_price,2).'€'  : 'nc' }}</td>
                                        <td>{{ !is_null($orderTemplateContentItem->step_value) ? number_format($orderTemplateContentItem->step_value,0)  : 'nc' }}</td>
                                        <td>{{ !is_null($orderTemplateContentItem->package_qty) ? number_format($orderTemplateContentItem->package_qty,0)  : 'nc' }}</td>
                                        <td {!! $totalQty <  $orderTemplateContentItem->step_value ? 'style="color : red; font-weight: bold"' : 'style="color : green; font-weight: bold"' !!}  >{{ $totalQty }}</td>
                                        <td>{{ number_format($orderTemplateContentItem->totalValue(),2).'€' }}</td>
                                        <td><a href="#" data-bs-toggle="tooltip" title="{{ $orderTemplateContentItem->comment }}">{!! Str::limit($orderTemplateContentItem->comment , 10, ' ...')  !!}</a></td>


                                        <td class="table-action">
                                            <a href="{{ route('orderTemplateContent.edit',$orderTemplateContentItem) }}" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                                            <form id="delete-{{ $index }}" method="POST" action="{{ route('orderTemplateContent.destroy',$orderTemplateContentItem) }}" class="d-sm-inline-block action-icon">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <a href="javascript:{}" onclick="document.getElementById('delete-{{ $index }}').submit(); return false;" style="color: inherit;"><i class="mdi mdi-delete"></i></a>
                                            </form>
                                        </td>

                                    </tr>

                                    @if ($orderTemplateContentItem->orders->count() > 0)
                                        <tr>
                                            <td></td>
                                            <td colspan="8">
                                                <table class="table mb-0">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">Pharmacie</th>
                                                        <td>Quantité</td>
                                                        <td>Commentaire</td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($orderTemplateContentItem->orders as $index => $orderItem)
                                                        <tr>
                                                            <th scope="col">{{ $orderItem->pharmacy->name }}</th>
                                                            <td>{{ $orderItem->qty }}</td>
                                                            <td><a href="#" data-bs-toggle="tooltip" title="{{ $orderItem->comment }}">{!! Str::limit($orderItem->comment , 20, ' ...')  !!}</a></td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @endif

                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        @endif

                    </div> <!-- end card-body/ profile-user-box-->
                </div>
                <!--end profile/ card -->
            </div> <!-- end col-->
        </div>
        <!-- end row -->


    </div> <!-- container -->
@endsection

