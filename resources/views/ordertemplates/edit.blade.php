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
                        <li class="breadcrumb-item"><a href="{{ route('orderTemplate.list') }}">Modèle de commande</a></li>

                        @if ($method === 'POST')
                            <li class="breadcrumb-item active">{{ __('Create') }}</li>
                        @else
                            <li class="breadcrumb-item">{{ $orderTemplate->brand->name }} ref {{ $orderTemplate->id }}</li>
                            <li class="breadcrumb-item active">{{ __('Edit') }}</li>
                        @endif

                    </ol>
                </div>
                @if ($method === 'POST')
                    <h4 class="page-title">Création d'un modèle de commande</h4>
                @else
                    <h4 class="page-title">Mise à jour du modèle de commande : {{ $orderTemplate->brand->name }} du {{ $orderTemplate->created_at->formatLocalized('%d %B %Y') }}</h4>
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
                        <input type="hidden" id="ordertemplate_id" name="ordertemplate_id" value={{ $orderTemplate->id }}>

                        <div class="row">
                            <div class="col-lg-6  mb-3">
                                <label for="title" class="form-label">Titre :</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       value="{{ $orderTemplate->title ? $orderTemplate->title : old('title') }}" required/>
                            </div>

                            <div class="col-lg-6  mb-3">
                                <label for="brand_id" class="form-label">Laboratoire :*</label>
                                <select name="brand_id" id="brand_id" class="form-control" required>
                                    <option value="">Choisir un laboratoire ...</option>
                                    @foreach($brands as $brand)
                                        <option value='{{ $brand->id }}' {{ $orderTemplate->brand_id ? ($orderTemplate->brand_id == $brand->id ? 'selected' : '') : ( old('brand_id') == $brand->id ? 'selected' : '') }}>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-lg-3  mb-3">
                                <label for="franco">Franco :*</label>
                                <input type="text" class="form-control" id="franco" name="franco"
                                       value="{{ $orderTemplate->franco ? $orderTemplate->franco : old('franco') }}" required />

                            </div>

                            <div class="col-lg-3  mb-3">
                                <label for="dead_line">Date de fermeture :</label>
                                <input type="text" class="form-control" id="dead_line" name="dead_line"
                                       value="{{ $orderTemplate->dead_line ? $orderTemplate->dead_line : old('dead_line') }}" required/>
                            </div>

                            <div class="col-lg-3 mb-3">
                                <label for="order_status">Statut*</label>
                                <select name="status" id="order_status" class="form-control" required>
                                    <option value="">Choisir un statut ...</option>
                                    <option value='Brouillon' {{ $orderTemplate->status ? ($orderTemplate->status == 'Brouillon' ? 'selected' : '') : ( old('status') == 'Brouillon' ? 'selected' : '') }}>Brouillon</option>
                                    <option value='Ouverte' {{ $orderTemplate->status ? ($orderTemplate->status == 'Ouverte' ? 'selected' : '') : ( old('status') == 'Ouverte' ? 'selected' : '') }}>Ouverte</option>
                                    <option value='Fermée' {{ $orderTemplate->status ? ($orderTemplate->status == 'Fermée' ? 'selected' : '') : ( old('status') == 'Fermée' ? 'selected' : '') }}>Fermée</option>
                                </select>
                            </div>


                            <div class="col-lg-3 mb-3 d-flex align-items-center">
                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" type="checkbox" id="multi_deliveries" name="multi_deliveries"
                                           value="1"
                                        {{ $orderTemplate->multi_deliveries == '1' ? 'checked' :''}}>
                                    <label class="form-check-label" for="multi_deliveries">Livraison multiple possibles ?</label>
                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-lg-12  mb-3">
                                <label for="comment">Commentaire libre :</label>
                                <textarea id="comment" name="comment" >{!!  $orderTemplate->comment ? $orderTemplate->comment : old('comment') !!}</textarea>
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
