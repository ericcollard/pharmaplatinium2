@extends('layouts.vertical')

@section('css')

    <style>
        p.thin {
            font-weight: normal;
        }
    </style>
@endsection


@section('content')
    <!-- Start Content-->
    <div class="d-flex justify-content-center  align-items-center" style="height: 80vh;">


        <h1  class="text-center">
            <img class="img-fluid" src="{{asset('assets/images/oups.png')}}" style="width: 50%;"><br>
            <p class="text-center mt-3">  {!! __("The requested resource doesn't exist")  !!} </p>
            @can('see-admin-only-data')
            <p class="text-center text-muted thin h4 mt-4"> #{{ $exception->getStatusCode()  }} : {{ __($exception->getMessage() ?: 'Not Found') }}</p>
            @endcan

        </h1>





    </div>

@endsection


@section('script-bottom')
@endsection


