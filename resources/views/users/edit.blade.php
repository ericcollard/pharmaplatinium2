@extends('layouts.vertical', ["page_title"=> "Mise à jour fiche pharmacie"])

@section('script-head')
    <script src="{{ asset('assets/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script>
        var editor_config = {
            path_absolute : "/",
            selector: 'textarea#comment',
            relative_urls: false,
            height: 400,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table directionality",
                "emoticons template paste textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            image_class_list: [
                {title: 'Fluid', value: 'cms-img-fluid'},
                {title: 'Fixed', value: ''},
            ],
            file_picker_callback : function(callback, value, meta) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
                if (meta.filetype == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.openUrl({
                    url : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no",
                    onMessage: (api, message) => {
                        callback(message.content);
                    }
                });
            }
        };




        tinymce.init(editor_config);

    </script>
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
                        <li class="breadcrumb-item"><a href="{{ route('user.list') }}">{{ __('Users') }}</a></li>
                        <li class="breadcrumb-item"><a href="#">{{ $user->name }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Edit') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">Mise à jour fiche pharmacie <b>{{ $user->name }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">


                    <form method="POST" action="{{ route('user.update',['user' => $user]) }}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <input type="hidden" id="user_id" name="user_id" value={{ $user->id }}>

                        <div class="row">
                            <div class="col-lg-6  mb-3">
                                <label for="name" class="form-label">Nom de la pharmacie* :</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ $user->name ? $user->name : old('name') }}" required/>
                            </div>

                            <div class="col-lg-6  mb-3">
                                <label for="email" class="form-label">{{ __('Email') }} :</label>
                                <input type="email" class="form-control" id="email"  name="email"
                                       value="{{ $user->email ? $user->email : old('email') }}"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6  mb-3">
                                <label for="prefered_spots">Adresse :</label>
                                <input type="text" class="form-control" id="adress" name="adress"
                                       value="{{ $user->adress ? $user->adress : old('adress') }}"/>
                            </div>

                            <div class="col-lg-2 mb-3 position-relative">
                                <label for="postal_code">Code postal :</label>
                                <input type="text" class="form-control" id="postal_code" name="postal_code"
                                       value="{{ $user->postal_code ? $user->postal_code : old('postal_code') }}"/>
                            </div>

                            <div class="col-lg-4 mb-3 position-relative">
                                <label for="city">Ville :</label>
                                <input type="text" class="form-control" id="city" name="city"
                                       value="{{ $user->city ? $user->city : old('city') }}"/>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-6  mb-3">
                                <label for="phone">Téléphone :</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                       value="{{ $user->phone ? $user->phone : old('phone') }}"/>
                            </div>
                                <div class="col-lg-6 mb-3 position-relative" id="datepicker2">
                                    <label for="last_login">Dernière connexion :</label>
                                    <input type="text" class="form-control" name="last_login" id="last_login" data-provide="datepicker" data-date-format="dd/mm/yyyy" data-date-langage="fr"  data-date-autoclose="true" data-date-container="#datepicker2" value="{{ $user->last_login ? $user->last_login->format('d/m/Y') : old('last_login') }}" >
                                </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12  mb-3">
                                <label for="comment">Commentaire libre :</label>
                                <textarea id="comment" name="comment" >{!!  $user->comment ? $user->comment : old('comment') !!}</textarea>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-lg-6  mb-3">
                                <label for="password">Mot de passe :</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" value="{{ old('password') }}">
                                    <div class="input-group-text" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                             </div>
                            @can('edit-userprofile-hidden-data',$user)
                                <div class="col-lg-6 mb-3 position-relative" id="datepicker3">
                                    <label for="email_verified_at">Email vérifié le :</label>
                                    <input type="text" class="form-control" name="email_verified_at" id="email_verified_at" data-provide="datepicker" data-date-format="dd/mm/yyyy" data-date-langage="fr"  data-date-autoclose="true" data-date-container="#datepicker3" value="{{ $user->email_verified_at ? $user->email_verified_at->format('d/m/Y') : old('email_verified_at') }}" >
                                </div>
                            @endcan
                        </div>

                        @can('edit-userprofile-hidden-data',$user)
                            <div class="row">
                                <div class="col-lg-6  mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="ROLE_ADMIN" id="roleCheck1" name="roles[]" {{ in_array("ROLE_ADMIN", $user->roles) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="roleCheck1">
                                            ROLE_ADMIN
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="ROLE_GESTIONNAIRE" id="roleCheck2" name="roles[]" {{ in_array("ROLE_GESTIONNAIRE", $user->roles) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="roleCheck2">
                                            ROLE_EDITOR
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="ROLE_CLIENT" id="roleCheck3" name="roles[]" {{ in_array("ROLE_CLIENT", $user->roles) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="roleCheck3">
                                            ROLE_CONTRIBUTOR
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="ROLE_VISITEUR" id="roleCheck4" name="roles[]" {{ in_array("ROLE_VISITEUR", $user->roles) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="roleCheck4">
                                            ROLE_VISITOR
                                        </label>
                                    </div>

                                </div>
                            </div>
                        @endcan

                        <div class="form-group mb-3">
                            <button id="btn_submit" type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>

                        @if (count($errors))
                            <ul class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </form>


                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->


</div> <!-- container -->
@endsection


@section('script-bottom')


@endsection
