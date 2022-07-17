@extends('layouts.vertical', ["page_title"=> "Commande pharmacie"])


@section('css')
    <style>
        .inferior {
            position: absolute;
            font-weight: lighter;
            line-height: 0.5rem;
            font-size: 0.5rem;
            left : 0;
            bottom: 2px;
        }

        .ref {
            position: relative;
        }

    </style>

@endsection


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
                            <li class="breadcrumb-item"><a href="{{ route('orderTemplate.list') }}">Commandes</a></li>
                            <li class="breadcrumb-item">{{ $orderTemplate->brand->name }} ref {{ $orderTemplate->id }}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Commande : {{ $orderTemplate->brand->name }} du {{ $orderTemplate->created_at->formatLocalized('%d %B %Y') }} pour {{ Auth::user()->name }}</h4>
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
                                <div class="mb-1"><span class="header-title">Donneur d'ordre : </span> <span class="text-muted">{{ Auth::user()->name }}</span></div>
                                <div class="mb-1"><span class="header-title">Date de cloture : </span> <span class="text-muted">{{ $orderTemplate->dead_line->formatLocalized('%d %B %Y') }}</span></div>
                                <div class="header-title">Commentaire</div>
                                <div class="text-muted  mb-1">
                                    {!! $orderTemplate->comment ?: 'nc' !!}
                                </div>
                            </div> <!-- end col-->

                            <div class="col-sm-6">
                                <div class="mb-1"><span class="header-title">Titre : </span> <span class="text-muted">{{ $orderTemplate->title }}</span></div>
                                <div class="mb-1"><span class="header-title">Montant commande groupée: </span> <span {!! $orderTemplate->totalValue() >=  $orderTemplate->franco ? 'style="color : green"' : 'style="color : red"' !!}>{{ number_format($orderTemplate->totalValue(),2).'€' }}</span></div>
                                <div class="mb-1"><span class="header-title">Valeur du franco : </span>
                                    <span class="text-muted">{{ !is_null($orderTemplate->franco) ? number_format($orderTemplate->franco,2).'€'  : 'nc' }}</span> {!! $orderTemplate->totalValue() <  $orderTemplate->franco ? ' <span class="badge bg-warning text-dark">Franco non atteint !</span>' : '' !!}
                                </div>
                                <div class="mb-1"><span class="header-title">Statut : </span> <span class="text-muted">{{ $orderTemplate->status }}</span></div>
                                <div class="mb-1"><span class="header-title">Gestionnaire : </span> <span class="text-muted">{{ $orderTemplate->brand->manager->name }}</span></div>
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
                        @if ($orderTemplate->content->count() > 0)


                            <form method="POST" action="{{ route('order.update',['orderTemplate' => $orderTemplate]) }}">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <input type="hidden" id="user_id" name="user_id" value={{ Auth::user()->id }}>


                            <div class="table-responsive-xl">
                            <table class="table table-sm align-middle">
                                <thead>
                                <tr>
                                    <th scope="col">EAN</th>
                                    <th scope="col">Produit</th>
                                    <th scope="col">Variante</th>
                                    <th scope="col">Colisage</th>
                                    <th scope="col">1/2</th>
                                    <th scope="col">Quantité</th>
                                    <th scope="col">Sous total</th>
                                    <th scope="col">Palier</th>
                                    <th scope="col">Qté totale</th>
                                    <th scope="col">Prix base</th>
                                    <th scope="col">Prix palier</th>

                                    <th scope="col">Comment</th>

                                </tr>
                                </thead>
                                <?php
                                    $orderValue = 0;
                                ?>
                                <tbody>
                                    @foreach($orders as $index => $order)
                                        <?php
                                            $totalQty = $order->orderTemplateContent->totalQty();
                                            $packageQty = !is_null($order->package_qty) ? number_format($order->package_qty,0)  : 'nc';
                                            $inpoutIndex = "#".$order->order_id."/".$packageQty."/".$order->ean."/".$order->demi_package;
                                            $orderValue+=$order->totalValue();
                                        ?>
                                    <tr>
                                        <th>{{ $order->ean }}</th>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->variant }}</td>
                                        <td>{{ $packageQty }}</td>
                                        <td>{!! $order->demi_package == 1 ? '<i class="mdi mdi-checkbox-marked-outline mdi-18px"></i>'  : '<i class="mdi mdi-checkbox-blank-outline mdi-18px"></i>' !!}</td>
                                        <td >
                                            <input type="text"
                                                   class="form-control @error($inpoutIndex) is-invalid @enderror"
                                                   id="{{ $inpoutIndex }}"
                                                   name="{{ $inpoutIndex }}"
                                                   value="{{ $order->qty }}"/>
                                            @error($inpoutIndex)
                                                @if ($order->demi_package == 1)
                                                    <div class="alert alert-danger">La quantité doit être multiple de {{ $packageQty/2 }}</div>
                                                @else
                                                    <div class="alert alert-danger">La quantité doit être multiple de {{ $packageQty }}</div>
                                                @endif
                                            @enderror

                                        </td>
                                        <td>{{ number_format($order->totalValue(),2).'€' }}</td>
                                        <td>{{ !is_null($order->step_value) ? number_format($order->step_value,0)  : 'nc' }}</td>
                                        <td {!! $totalQty <  $order->step_value ? 'style="color : red; font-weight: bold"' : 'style="color : green; font-weight: bold"' !!}  class="ref">
                                            {{ $totalQty }}
                                            @if ($totalQty <  $order->step_value)
                                                <span class="inferior">Quantité palier<br>non atteinte</span>
                                            @endif
                                        </td>

                                        <td {!! $totalQty <  $order->step_value ? 'style="color : red; font-weight: bold"' : 'style="text-decoration: line-through"' !!}  >
                                            {{ !is_null($order->price) ?
                                                number_format($order->price*(1-$order->discount),2).'€ (-'.number_format($order->discount*100,0).'%)'
                                                : 'nc' }}
                                        </td>


                                        <td {!! $totalQty >=  $order->step_value ? 'style="color : green; font-weight: bold"' : 'style="text-decoration: line-through"' !!}  >{{ !is_null($order->step_price) ? number_format($order->step_price,2).'€'  : 'nc' }}</td>

                                        <td><a href="#" data-bs-html="true"  data-bs-toggle="tooltip" title="{{ $order->comment }}">{!! Str::limit($order->comment , 10, ' ...')  !!}</a></td>

                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5" class="text-end">Valeur totale de la commande de {{ Auth::user()->name }}</td>
                                        <td >{{ number_format($orderValue,2).'€' }}</td>
                                        <td colspan="5"></td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                                <div class="row">
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        @can ('update_for_user', $orderTemplate)
                                        <button id="btn_submit" type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                                        @endcan
                                    </div>
                            </form>
                                </div>
                                <div class="col-6 text-end"  >
                                    <div class="form-group mb-3">
                                        @can ('update_for_user', $orderTemplate)
                                        <form class="deleteconfirm d-sm-inline-block action-icon" action="{{ route('order.destroy',$orderTemplate->id) }}" method="POST" onsubmit="return confirm('Etes vous sur de vouloir supprimer votre commande ?')">
                                            <input type="hidden" name="_method" value="DELETE">
                                            {{ csrf_field() }}
                                            <button id="btn_submit" type="submit" class="btn btn-danger">Supprimer la commande</button>
                                        </form>
                                        @endcan
                                    </div>
                                </div>
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

