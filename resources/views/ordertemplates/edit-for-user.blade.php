@extends('layouts.vertical', ["page_title"=> "Commande pharmacie"])

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
                                <div class="mb-1"><span class="header-title">Donneur d'ordre : </span> <span class="text-muted">Pharmacie {{ Auth::user()->name }}</span></div>
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
                                <div class="mb-1"><span class="header-title">Montant commande groupée: </span> <span {!! $orderTemplate->totalValue() >=  $orderTemplate->franco ? 'style="color : green"' : 'style="color : red"' !!}>{{ number_format($orderTemplate->totalValue(),2).'€' }}</span></div>
                                <div class="mb-1"><span class="header-title">Valeur du franco : </span> <span class="text-muted">{{ !is_null($orderTemplate->franco) ? number_format($orderTemplate->franco,2).'€'  : 'nc' }}</span></div>
                                <div class="mb-1"><span class="header-title">Statut : </span> <span class="text-muted">{{ $orderTemplate->status }}</span></div>
                                <div class="mb-1"><span class="header-title">Gestionnaire : </span> <span class="text-muted">Pharmacie {{ $orderTemplate->brand->manager->name }}</span></div>

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
                                    <th scope="col">Quantité</th>
                                    <th scope="col">Sous total</th>
                                    <th scope="col">Palier</th>
                                    <th scope="col">Qté totale</th>
                                    <th scope="col">Prix base</th>
                                    <th scope="col">Prix palier</th>

                                    <th scope="col">Comment</th>

                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $index => $order)
                                        <?php
                                            $totalQty = $order->orderTemplateContent->totalQty();
                                            $packageQty = !is_null($order->package_qty) ? number_format($order->package_qty,0)  : 'nc';
                                            $inpoutIndex = "#".$order->order_id."/".$packageQty."/".$order->ean;
                                        ?>
                                    <tr>
                                        <th>{{ $order->ean }}</th>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->variant }}</td>
                                        <td>{{ $packageQty }}</td>
                                        <td >
                                            <input type="text"
                                                   class="form-control @error($inpoutIndex) is-invalid @enderror"
                                                   id="{{ $inpoutIndex }}"
                                                   name="{{ $inpoutIndex }}"
                                                   value="{{ $order->qty }}"/>
                                            @error($inpoutIndex)
                                                <div class="alert alert-danger">La quantité doit être multiple de {{ $packageQty }}</div>
                                            @enderror

                                        </td>
                                        <td>{{ number_format($order->totalValue(),2).'€' }}</td>
                                        <td>{{ !is_null($order->step_value) ? number_format($order->step_value,0)  : 'nc' }}</td>
                                        <td {!! $totalQty <  $order->step_value ? 'style="color : red; font-weight: bold"' : 'style="color : green; font-weight: bold"' !!}  >{{ $totalQty }}</td>
                                        <td {!! $totalQty <  $order->step_value ? 'style="color : red; font-weight: bold"' : 'style="text-decoration: line-through"' !!}  >{{ !is_null($order->price) ? number_format($order->price,2).'€'  : 'nc' }}</td>
                                        <td {!! $totalQty >=  $order->step_value ? 'style="color : green; font-weight: bold"' : 'style="text-decoration: line-through"' !!}  >{{ !is_null($order->step_price) ? number_format($order->step_price,2).'€'  : 'nc' }}</td>

                                        <td><a href="#" data-bs-toggle="tooltip" title="{{ $order->comment }}">{!! Str::limit($order->comment , 10, ' ...')  !!}</a></td>

                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                            </div>

                                <div class="form-group mb-3">
                                    <button id="btn_submit" type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                                </div>

                            </form>


                        @endif

                    </div> <!-- end card-body/ profile-user-box-->
                </div>
                <!--end profile/ card -->
            </div> <!-- end col-->
        </div>
        <!-- end row -->


    </div> <!-- container -->
@endsection

