@extends('layouts.vertical', ["page_title"=> "Liste des commandes ouvertes jamais remplies"])



@section('css')


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
                            <li class="breadcrumb-item">Commandes</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Liste des commandes ouvertes</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table caption-top">
                                <caption>List of users</caption>
                                <thead>
                                <tr>
                                    <th scope="col">Gestionnaire</th>
                                    <th scope="col">Laboratoire</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Date de cloture</th>
                                    <th scope="col">Lien</th>
                                </tr>
                                </thead>
                                <tbody>


                                @foreach($listOfFreeOrders as $index => $orderTemplate)
                                <tr>
                                    <td><a href="{{ route('user.show',$orderTemplate->brand->manager) }}">{{ $orderTemplate->brand->manager->name }}</a></td>
                                    <td><a href="{{ route('brand.show',$orderTemplate->brand) }}">{{ $orderTemplate->brand->name }}</a></td>
                                    <td>{{ $orderTemplate->title }}</td>
                                    <td>{{ $orderTemplate->dead_line->formatLocalized('%d %B %Y') }}</td>
                                    <td><a href="{{ route('order.edit' , ['orderTemplate' => $orderTemplate]) }}">{{ route('order.edit' , ['orderTemplate' => $orderTemplate]) }}</a></td>
                                </tr>
                                @endforeach


                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div><!-- end col-12-->
        </div><!-- end row-->

    </div>

@endsection


@section('script-bottom')

@endsection


