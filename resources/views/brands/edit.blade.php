@extends('layouts.vertical', ["page_title"=> "Mis à jour fiche Laboratoire"])

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
                        <li class="breadcrumb-item"><a href="{{ route('brand.list') }}">Laboratoires</a></li>

                        @if ($method === 'POST')
                            <li class="breadcrumb-item active">{{ __('Create') }}</li>
                        @else
                            <li class="breadcrumb-item"><a href="{{ $brand->path() }}">{{ $brand->name }}</a></li>
                            <li class="breadcrumb-item active">{{ __('Edit') }}</li>
                        @endif

                    </ol>
                </div>
                @if ($method === 'POST')
                    <h4 class="page-title">Création d'un laboratoire</h4>
                @else
                    <h4 class="page-title">Mise à jour fiche Laboratoire <b>{{ $brand->name }}</h4>
                @endif

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <form method="POST" action="{{ $action }}">
                        {{ csrf_field() }}
                        {{ method_field($method) }}
                        <input type="hidden" id="brand_id" name="brand_id" value={{ $brand->id }}>

                        <div class="row">
                            <div class="col-lg-6  mb-3">
                                <label for="name" class="form-label">Nom du laboratoire* :</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ $brand->name ? $brand->name : old('name') }}" required/>
                            </div>

                            <div class="col-lg-6  mb-3">
                                <label for="contact_email" class="form-label">Email du contact :</label>
                                <input type="email" class="form-control" id="contact_email" name="contact_email"
                                       value="{{ $brand->contact_email ? $brand->contact_email : old('contact_email') }}"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3  mb-3">
                                <label for="manager_id">Pharmacie gestionnaire :</label>

                                <select name="manager_id" id="manager_id" class="form-control" required>
                                    <option value="">Choisir un gestionnaire ...</option>
                                    @foreach($users as $user)
                                        <option value='{{ $user->id }}' {{ $brand->manager_id ? ($brand->manager_id == $user->id ? 'selected' : '') : ( old('manager_id') == $user->id ? 'selected' : '') }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>


                            </div>

                            <div class="col-lg-3  mb-3">
                                <label for="contact_name">Nom du contact :</label>
                                <input type="text" class="form-control" id="contact_name" name="contact_name"
                                       value="{{ $brand->contact_name ? $brand->contact_name : old('contact_name') }}"/>
                            </div>

                            <div class="col-lg-3 mb-3 position-relative">
                                <label for="postal_code">Téléphone du contact :</label>
                                <input type="text" class="form-control" id="contact_phone" name="contact_phone"
                                       value="{{ $brand->contact_phone ? $brand->contact_phone : old('contact_phone') }}"/>
                            </div>

                            <div class="col-lg-3 mb-3 position-relative">
                                <label for="discount">Remise standard* (0.3 pour 30%):</label>
                                <input type="text" class="form-control" id="discount" name="discount"
                                           value="{{ !is_null($brand->discount) ? $brand->discount : old('discount') }}"/>

                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-12  mb-3">
                                <label for="comment">Commentaire libre :</label>
                                <textarea id="comment" name="comment" >{!!  $brand->comment ? $brand->comment : old('comment') !!}</textarea>
                            </div>
                        </div>

                        <hr>


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
