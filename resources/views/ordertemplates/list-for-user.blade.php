@extends('layouts.vertical', ["page_title"=> "Liste des commandes"])



@section('css')


    <!-- third party css -->
    <link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- third party css end -->

    <style>

        div.dataTables_wrapper div.dataTables_filter
        {
            float: right;
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
                            <li class="breadcrumb-item">Commandes</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Liste des commandes</h4>
                    <p>Filtres appliqués :</p>
                    <ul>
                        <li>Donneur d'ordre : {{ Auth::user()->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        {{$dataTable->table(['class' => 'table dt-responsive nowrap w-100'])}}

                    </div>
                </div>
            </div><!-- end col-12-->
        </div><!-- end row-->

    </div>

@endsection


@section('script-bottom')

    <!-- third party js -->

    <script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    <!-- third party js ends -->
    {{$dataTable->scripts()}}

@endsection


