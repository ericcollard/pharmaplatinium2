@extends('layouts.vertical', ["page_title"=> "Liste des emails"])



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
                            <li class="breadcrumb-item"><a href="#">Pharmacies</a></li>
                            <li class="breadcrumb-item active">Liste des emails</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Liste des emails de pharmacies</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        @foreach($users as $users)
                            {{ $users->email }},
                        @endforeach

                    </div>
                </div>
            </div><!-- end col-12-->
        </div><!-- end row-->

    </div>

@endsection


@section('script-bottom')

@endsection


