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
            <h2 class="page-title">Commande : {{ $orderTemplate->brand->name }} du {{ $orderTemplate->created_at->formatLocalized('%d %B %Y') }}</h2>
        </div>
    </div>
    <!-- end page title -->



    <div class="row">
        <div class="col-sm-6">
            <div class="mb-1"><span class="header-title">Gestionnaire : </span> {{ $orderTemplate->brand->manager->name }}</div>
            <div class="mb-1"><span class="header-title">Date de cloture : </span> {{ $orderTemplate->dead_line->formatLocalized('%d %B %Y') }}</div>
            <div class="header-title">Commentaire</div>
            <div class="mb-1">
                {!! $orderTemplate->comment ?: 'nc' !!}
            </div>
        </div> <!-- end col-->

        <div class="col-sm-6">
            <div class="mb-1"><span class="header-title">Titre : </span>{{ $orderTemplate->title }}</div>
            <div class="mb-1"><span class="header-title">Montant de la commande : </span> {{ number_format($orderTemplate->totalValue(),2).'€' }}</div>
            <div class="mb-1"><span class="header-title">Valeur du franco : </span> {{ !is_null($orderTemplate->franco) ? number_format($orderTemplate->franco,2).'€'  : 'nc' }}</div>
        </div> <!-- end col-->



        <div class="col-sm-12">

        @foreach($orders as $key => $order)
            <h3>{{ $key }}</h3>
            <table class="table table-sm">
                <thead>
                <tr>
                    <th scope="col">EAN</th>
                    <th scope="col">Produit</th>
                    <th scope="col">Variante</th>
                    <th scope="col">Qté</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($order as  $orderLine)
                        @if ($orderLine->qty > 0)
                        <tr>
                            <td>{{ $orderLine->ean }}</td>
                            <td>{{ $orderLine->name }}</td>
                            <td>{{ $orderLine->variant }}</td>
                            <td>{{ $orderLine->qty }}</td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

            </ul>

        @endforeach


            <!--end profile/ card -->
        </div> <!-- end col-->
    </div>
    <!-- end row -->


</div> <!-- container -->






</body>
</html>
