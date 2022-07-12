@extends('layouts.vertical', ["page_title"=> "Mise à jour ligne de modèle de commande"])

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
                        <li class="breadcrumb-item"><a href="{{ route('orderTemplate.list') }}">Modèles de commande</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('orderTemplate.show', ['orderTemplate' =>  $orderTemplateContent->orderTemplate]) }}">Ref {{ $orderTemplateContent->orderTemplate->id }}</a></li>
                        <li class="breadcrumb-item">Lignes de commande</li>
                        @if ($method === 'POST')
                            <li class="breadcrumb-item active">{{ __('Create') }}</li>
                        @else

                        @endif

                    </ol>
                </div>
                @if ($method === 'POST')
                    <h4 class="page-title">Ajout d'une ligne pour le modèle de commande Ref {{ $orderTemplateContent->orderTemplate->id }}</h4>
                @else
                    <h4 class="page-title">Mise à jour d'une ligne pour le modèle de commande Ref {{ $orderTemplateContent->orderTemplate->id }}</h4>
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
                        <input type="hidden" id="ordertemplate_id" name="ordertemplate_id" value={{ $orderTemplateContent->ordertemplate_id }}>

                        <div class="row">
                            <div class="col-lg-3  mb-3">
                                <label for="ean" class="form-label">EAN* :</label>
                                <input type="text" class="form-control" id="ean" name="ean"
                                       value="{{ $orderTemplateContent->ean ? $orderTemplateContent->ean : old('ean') }}" required/>
                            </div>

                            <div class="col-lg-6  mb-3">
                                <label for="name" class="form-label">Désignation* :</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ $orderTemplateContent->name ? $orderTemplateContent->name : old('name') }}" required/>
                            </div>

                            <div class="col-lg-3  mb-3">
                                <label for="variant">Variante :</label>
                                <input type="text" class="form-control" id="variant" name="variant"
                                       value="{{ $orderTemplateContent->variant ? $orderTemplateContent->variant : old('variant') }}" />

                            </div>

                        </div>

                        <div class="row">


                            <div class="col-lg-3  mb-3">
                                <label for="price">Prix catalogue* :</label>
                                <input type="text" class="form-control" id="price" name="price"
                                       value="{{ $orderTemplateContent->price ? $orderTemplateContent->price : old('price') }}" required/>
                            </div>

                            <div class="col-lg-3 mb-3">
                                <label for="step_price">Remise standard* (0.3 pour 30%):</label>
                                <input type="text" class="form-control" id="discount" name="discount"
                                       value="{{ $orderTemplateContent->discount ? $orderTemplateContent->discount : old('discount') }}" required/>
                            </div>


                            <div class="col-lg-3 mb-3">
                                <label for="step_price">Prix palier* :</label>
                                <input type="text" class="form-control" id="step_price" name="step_price"
                                       value="{{ $orderTemplateContent->step_price ? $orderTemplateContent->step_price : old('step_price') }}" required/>
                            </div>

                            <div class="col-lg-3 mb-3 position-relative">
                                <label for="step_value">Quantité palier* :</label>
                                <input type="text" class="form-control" id="step_value" name="step_value"
                                       value="{{ $orderTemplateContent->step_value ? $orderTemplateContent->step_value : old('step_value') }}" required/>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-3  mb-3">
                                <label for="package_qty">Colisage* :</label>
                                <input type="text" class="form-control" id="package_qty" name="package_qty"
                                       value="{{ $orderTemplateContent->package_qty ? $orderTemplateContent->package_qty : old('package_qty') }}" required />

                            </div>

                            <div class="col-lg-3  mb-3">
                                <input class="form-check-input" type="checkbox" id="demi_package" name="demi_package"
                                       value="1"
                                {{ $orderTemplateContent->demi_package === '1' ? 'checked' :''}}
                                <label class="form-check-label" for="demi_package">Demi-colisage possibles ?</label>
                            </div>





                        </div>




                        <div class="row">

                            <div class="col-lg-3 mb-3 position-relative">
                                <input class="form-check-input" type="checkbox" id="free" name="free"
                                       value="1"
                                {{ $orderTemplateContent->free === '1' ? 'checked' :''}}
                                <label class="form-check-label" for="free"> Gratuité ?</label>
                            </div>

                            <div class="col-lg-3  mb-3">
                                <label for="free_stp">Palier de gratuité :</label>
                                <input type="text" class="form-control" id="free_stp" name="free_stp"
                                       value="{{ $orderTemplateContent->free_stp ? $orderTemplateContent->free_stp : old('free_stp') }}"  />
                            </div>

                            <div class="col-lg-3  mb-3">
                                <label for="free_qty">Quantité de gratuité :</label>
                                <input type="text" class="form-control" id="free_qty" name="free_qty"
                                       value="{{ $orderTemplateContent->free_qty ? $orderTemplateContent->free_qty : old('free_qty') }}"  />
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-3 mb-3">
                                <input class="form-check-input" type="checkbox" id="multi_delivery" name="multi_delivery"
                                       value="1"
                                {{ $orderTemplateContent->multi_delivery === '1' ? 'checked' :''}}
                                <label class="form-check-label" for="multi_delivery">Livraison multiple possibles ?</label>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-lg-12  mb-3">
                                <label for="comment">Commentaire libre :</label>
                                <textarea id="comment" name="comment" >{!!  $orderTemplateContent->comment ? $orderTemplateContent->comment : old('comment') !!}</textarea>
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
