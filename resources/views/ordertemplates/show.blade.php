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
                                <div class="mb-1"><span class="header-title">Gestionnaire : </span> <span class="text-muted"><a href="{{ route('user.show',$orderTemplate->brand->manager) }}">{{ $orderTemplate->brand->manager->name }}</a></span></div>
                                <div class="mb-1"><span class="header-title">Laboratoire : </span> <span class="text-muted"><a href="{{ route('brand.show',$orderTemplate->brand) }}">{{ $orderTemplate->brand->name }}</a></span></div>
                                <div class="mb-1"><span class="header-title">Date de cloture : </span> <span class="text-muted">{{ $orderTemplate->dead_line->formatLocalized('%d %B %Y') }}</span></div>

                            </div> <!-- end col-->

                            <div class="col-sm-6">


                                <div class="text-center mt-sm-0 mt-3 text-sm-end">

                                    @can ('delete', $orderTemplate)
                                        <form class="d-sm-inline-block mx-1 mb-1" method="POST" action="{{ route('orderTemplate.destroy',['orderTemplate' => $orderTemplate]) }}"
                                              onsubmit="return confirm('Etes vous sur de vouloir supprimer cette commande ? Cela entrainera la suppression des commandes éventuellement passées par les pharmacies sur les références considérées.')">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger"> {{ __('Delete') }}</button>
                                        </form>
                                    @endcan

                                    @can ('update', $orderTemplate)
                                    <button type="button" class="btn btn-warning mx-1 mb-1">
                                        <a href="{{ route('orderTemplate.edit' , ['orderTemplate' => $orderTemplate]) }}" style="color: inherit">
                                            <i class="mdi mdi-account-edit me-1"></i> Mise à jour
                                        </a>
                                    </button>
                                    @endcan

                                    @can ('duplicate', $orderTemplate)
                                        <button type="button" class="btn btn-success mx-1 mb-1">
                                            <a href="{{ route('orderTemplate.duplicate' , ['orderTemplate' => $orderTemplate]) }}" style="color: inherit">
                                                <i class="mdi mdi-content-duplicate me-1"></i> Dupliquer
                                            </a>
                                        </button>
                                    @endcan

                                    @can ('reorder', $orderTemplate)
                                            <button type="button" class="btn btn-danger mx-1 mb-1">
                                                <a href="{{ route('orderTemplate.sort' , ['orderTemplate' => $orderTemplate]) }}" style="color: inherit">
                                                    <i class="mdi mdi-sort-ascending me-1"></i> Reclasser
                                                </a>
                                            </button>
                                    @endcan

                                    @can ('print', $orderTemplate)
                                        <button type="button" class="btn btn-primary mx-1 mb-1">
                                            <a href="{{ route('orderTemplate.print' , ['orderTemplate' => $orderTemplate]) }}" style="color: inherit">
                                                <i class="mdi mdi-printer me-1"></i> Par produit
                                            </a>
                                        </button>
                                        <button type="button" class="btn btn-primary mx-1 mb-1">
                                            <a href="{{ route('orderTemplate.print2' , ['orderTemplate' => $orderTemplate]) }}" style="color: inherit">
                                                <i class="mdi mdi-printer me-1"></i> par Pharmacie
                                            </a>
                                        </button>
                                            <button type="button" class="btn btn-primary mx-1 mb-1">
                                                <a href="{{ route('orderTemplate.print3' , ['orderTemplate' => $orderTemplate]) }}" style="color: inherit">
                                                    <i class="mdi mdi-printer me-1"></i> Pour commande
                                                </a>
                                            </button>
                                    @endcan

                                </div>
                            </div> <!-- end col-->
                        </div> <!-- end row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-1"><span class="header-title">LIEN commande : </span> <span class="text-muted"><a href="{{ route('order.edit' , ['orderTemplate' => $orderTemplate]) }}">{{ route('order.edit' , ['orderTemplate' => $orderTemplate]) }}</a></span></div>
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
                                <div class="mb-1"><span class="header-title">Livraison multiple : </span>{!! $orderTemplate->multi_deliveries == 1 ? '<i class="mdi mdi-checkbox-marked-outline mdi-18px"></i>'  : '<i class="mdi mdi-checkbox-blank-outline mdi-18px"></i>' !!} <span class="text-muted">(fonctionnalité non active)</span></div>
                                <div class="mb-1"><span class="header-title">Franco obligatoire : </span>{!! $orderTemplate->franco_required == 1 ? '<i class="mdi mdi-checkbox-marked-outline mdi-18px"></i>'  : '<i class="mdi mdi-checkbox-blank-outline mdi-18px"></i>' !!} <span class="text-muted"></span>
                                    @if ($orderTemplate->franco_required == 1 and $orderTemplate->totalValue() <  $orderTemplate->franco)
                                        <span class="alert alert-danger">LE FRANCO N'A PAS ETE ATTEINT, Cette commande ne sera pas validée !</span>
                                    @endif
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
                                    <th scope="col">Qté Palier</th>
                                    <th scope="col">Colisage</th>
                                    <th scope="col">1/2 colis</th>
                                    <th scope="col">Qté totale</th>
                                    <th scope="col">Sous total</th>
                                    <th scope="col">Commentaire</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($orderTemplate->content()->orderBy('sort')->get() as $index => $orderTemplateContentItem)
                                        <?php
                                            $totalQty = $orderTemplateContentItem->totalQty();
                                        ?>
                                    <tr>
                                        <th scope="row">{{ $orderTemplateContentItem->ean }}</th>
                                        <td>{{ $orderTemplateContentItem->name }}</td>
                                        <td>{{ $orderTemplateContentItem->variant }}</td>
                                        <td {!! (is_null($orderTemplateContentItem->step_value) or is_null($orderTemplateContentItem->step_price) or $totalQty <  $orderTemplateContentItem->step_value) ? 'style="color : red; font-weight: bold"' : 'style="text-decoration: line-through"' !!}  >
                                            {{ !is_null($orderTemplateContentItem->price) ?
                                                number_format($orderTemplateContentItem->price,2).'€ - '.number_format($orderTemplateContentItem->discount*100,2).'% = '.number_format($orderTemplateContentItem->price*(1-$orderTemplateContentItem->discount),2).'€'
                                                : 'nc' }}
                                        <td {!! (!is_null($orderTemplateContentItem->step_value) && !is_null($orderTemplateContentItem->step_price) && $totalQty >=  $orderTemplateContentItem->step_value) ? 'style="color : green; font-weight: bold"' : 'style="text-decoration: line-through"' !!}>
                                            {{ !is_null($orderTemplateContentItem->step_price) ? number_format($orderTemplateContentItem->step_price,2).'€'  : 'nc' }}
                                        </td>
                                        <td>{{ !is_null($orderTemplateContentItem->step_value) ? number_format($orderTemplateContentItem->step_value,0)  : 'nc' }}</td>
                                        <td>{{ !is_null($orderTemplateContentItem->package_qty) ? number_format($orderTemplateContentItem->package_qty,0)  : 'nc' }}</td>
                                        <td>{!! $orderTemplateContentItem->demi_package == 1 ? '<i class="mdi mdi-checkbox-marked-outline mdi-18px"></i>'  : '<i class="mdi mdi-checkbox-blank-outline mdi-18px"></i>' !!}</td>
                                        <td {!! (is_null($orderTemplateContentItem->step_value) or is_null($orderTemplateContentItem->step_price) or $totalQty <  $orderTemplateContentItem->step_value) ? 'style="color : red; font-weight: bold"' : 'style="color : green; font-weight: bold"' !!}  >{{ $totalQty }}</td>
                                        <td>{{ number_format($orderTemplateContentItem->totalValue(),2).'€' }}</td>
                                        <td><a href="#" data-bs-html="true" data-bs-toggle="tooltip" title="{{ $orderTemplateContentItem->comment }}">{!! Str::limit($orderTemplateContentItem->comment , 10, ' ...')  !!}</a></td>


                                        <td class="table-action" NOWRAP>
                                            @if (! $loop->first)
                                                <a href="{{ route('orderTemplateContent.moveup',$orderTemplateContentItem) }}" class="action-icon" title="Remonter"> <i class="mdi mdi-arrow-up-bold"></i></a>
                                            @endif
                                            @if (! $loop->last)
                                                <a href="{{ route('orderTemplateContent.movedown',$orderTemplateContentItem) }}" class="action-icon" title="Descendre"> <i class="mdi mdi-arrow-down-bold"></i></a>
                                            @endif
                                            <a href="{{ route('orderTemplateContent.edit',$orderTemplateContentItem) }}" class="action-icon" title="Modifier"> <i class="mdi mdi-pencil"></i></a>
                                            <a href="{{ route('orderTemplateContent.duplicate',$orderTemplateContentItem) }}" class="action-icon" title="Dupliquer"> <i class="mdi mdi-content-duplicate"></i></a>
                                            <a href="{{ route('orderTemplateContent.insert',$orderTemplateContentItem) }}" class="action-icon" title="Insérer avant"> <i class="mdi mdi-table-row-plus-before"></i></a>
                                            <form class="delete d-sm-inline-block action-icon" action="{{ route('orderTemplateContent.destroy',$orderTemplateContentItem) }}" method="POST">
                                                <input type="hidden" name="_method" value="DELETE">
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-default btn-lg" style="color: inherit;"><i class="mdi mdi-delete"></i></button>
                                            </form>

                                        </td>

                                    </tr>

                                    @if ($orderTemplateContentItem->orders->count() > 0)
                                        <tr>
                                            <td></td>
                                            <td colspan="8">
                                                <table class="table mb-3 table-sm">
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
                                                            <td>{{ $orderItem->pharmacy->name }}</td>
                                                            <td>{{ $orderItem->qty }}</td>
                                                            <td><a href="#" data-bs-html="true"  data-bs-toggle="tooltip" title="{{ $orderItem->comment }}">{!! Str::limit($orderItem->comment , 20, ' ...')  !!}</a></td>
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


@section('script-bottom')

    <script>
        $(".delete").on("submit", function(){
            return confirm("Etes vous sur de vouloir supprimer cette ligne de commande ? Cela entrainera la suppression des commandes éventuellement passées par les pharmacies sur cette référence.");
        });
    </script>
@endsection



