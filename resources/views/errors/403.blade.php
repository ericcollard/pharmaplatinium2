@extends('layouts.vertical', ["page_title"=> "Accès interdit"])

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
                <p class="text-center mt-3">  {{ __($exception->getMessage() ?: 'Forbidden') }}</p>
                <p class="text-center text-muted h4">#{{ $exception->getStatusCode()  }} :
                    Les autorisations liées à votre profil sont insuffisantes pour vous
                permettre d'accéder à cette page.</p>
                <p class="text-center text-muted thin h4 mt-4">
                    @if (Auth::guest())
                        Utilisateur non connecté
                    @else
                        Utilisateur connecté : <a href="{{  Auth::user()->path() }}">{{ Auth::user()->name }}</a><br>
                        Identifiant : {{ Auth::user()->id }}<br>
                        Rôle(s) :
                            @foreach( Auth::user()->getRoles() as $role)
                                {{ $role }}
                            @endforeach
                    @endif

            </h1>





    </div>

@endsection


@section('script-bottom')
@endsection


