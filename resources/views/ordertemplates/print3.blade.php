<html>
<head>
    <link href=/assets/css/icons.min.css" rel="stylesheet" type="text/css"/>

    <link href="/assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-print-css/css/bootstrap-print.min.css" media="print">
    <style>
        body {
            background-color: white;
        }

    </style>

</head>
<body>


<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Modèle de commande : {{ $orderTemplate->brand->name }} du {{ $orderTemplate->dead_line->formatLocalized('%d %B %Y') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->



    <div class="row">
        <div class="col-sm-6">
            <div class="mb-1"><span class="header-title">Gestionnaire : </span> {{ $orderTemplate->brand->manager->name }}</div>
        </div> <!-- end col-->

        <div class="col-sm-6">
            <div class="mb-1"><span class="header-title">Titre : </span>{{ $orderTemplate->title }}</div>
            <div class="mb-1"><span class="header-title">Montant de la commande : </span> {{ number_format($orderTemplate->totalValue(),2).'€' }}</div>
        </div> <!-- end col-->

        <div class="col-sm-12">


                    @if ($orderTemplate->content->count() > 0)

                            <table class="table table-sm mt-4">
                                <thead>
                                <tr>
                                    <th scope="col">EAN</th>
                                    <th scope="col">Produit</th>
                                    <th scope="col">Variante</th>
                                    <th scope="col">Prix</th>
                                    <th scope="col">Prix palier</th>
                                    <th scope="col">Qté Palier</th>
                                    <th scope="col">Colisage</th>
                                    <th scope="col">Qté totale</th>
                                    <th scope="col">Sous total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orderTemplate->content as $index => $orderTemplateContentItem)
                                    <?php
                                    $totalQty = $orderTemplateContentItem->totalQty();
                                    ?>
                                    <tr>
                                        <th scope="row">{{ $orderTemplateContentItem->ean }}</th>
                                        <td>{{ $orderTemplateContentItem->name }}</td>
                                        <td>{{ $orderTemplateContentItem->variant }}</td>
                                        <td {!! (is_null($orderTemplateContentItem->step_value) or is_null($orderTemplateContentItem->step_price) or $totalQty <  $orderTemplateContentItem->step_value) ? 'style="color : red; font-weight: bold"' : 'style="text-decoration: line-through"' !!}  >
                                        {{ !is_null($orderTemplateContentItem->price) ?
                                            number_format($orderTemplateContentItem->price*(1-$orderTemplateContentItem->discount),2).'€ (-'.number_format($orderTemplateContentItem->discount*100,2).'%)'
                                            : 'nc' }}
                                        <td {!! (!is_null($orderTemplateContentItem->step_value) && !is_null($orderTemplateContentItem->step_price) && $totalQty >=  $orderTemplateContentItem->step_value) ? 'style="color : green; font-weight: bold"' : 'style="text-decoration: line-through"' !!}>
                                            {{ !is_null($orderTemplateContentItem->step_price) ? number_format($orderTemplateContentItem->step_price,2).'€'  : 'nc' }}
                                        </td>
                                        <td>{{ !is_null($orderTemplateContentItem->step_value) ? number_format($orderTemplateContentItem->step_value,0)  : 'nc' }}</td>
                                        <td>{{ !is_null($orderTemplateContentItem->package_qty) ? number_format($orderTemplateContentItem->package_qty,0)  : 'nc' }}</td>
                                        <td {!! (is_null($orderTemplateContentItem->step_value) or is_null($orderTemplateContentItem->step_price) or $totalQty <  $orderTemplateContentItem->step_value) ? 'style="color : red; font-weight: bold"' : 'style="color : green; font-weight: bold"' !!}  >{{ $totalQty }}</td>
                                        <td>{{ number_format($orderTemplateContentItem->totalValue(),2).'€' }}</td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                    @endif


            <!--end profile/ card -->
        </div> <!-- end col-->
    </div>
    <!-- end row -->


</div> <!-- container -->






</body>
</html>
