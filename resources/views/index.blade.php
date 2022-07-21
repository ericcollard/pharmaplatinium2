@extends('layouts.vertical', ["page_title"=> "Dashboard"])

@section('css')
<!-- third party css -->
<link href="{{asset('assets/libs/admin-resources/admin-resources.min.css')}}" rel="stylesheet" type="text/css">
</link>
<!-- third party css end -->
@endsection

@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">

                </div>
                <h4 class="page-title">Tableau de bord</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end">
                        <img src="{{asset('assets/images/icon-foil.png')}}" alt="" class="img-fluid" />
                    </div>
                    <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Pharmacies : <b>{{ $dashboard['userCnt'] }}</b></h5>
                    <p class="mb-0 text-muted">
                        <span class="text-nowrap text-success "><a href="{{ route('user.list') }}">Toutes les pharmacies</a></span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end">
                        <img src="{{asset('assets/images/icon-foil.png')}}" alt="" class="img-fluid" />
                    </div>
                    <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Laboratoires : <b>{{ $dashboard['brandCnt'] }}</b></h5>
                    <p class="mb-0 text-muted">
                        <span class="text-nowrap text-success "><a href="{{ route('brand.list') }}">Tous les laboratoires</a></span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end">
                        <img src="{{asset('assets/images/icon-foil.png')}}" alt="" class="img-fluid" />
                    </div>
                    <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Commandes groupées : <b>{{ $dashboard['orderTemplateCnt'] }}</b></h5>
                    <p class="mb-0 text-muted">
                        <span class="text-nowrap text-success "><a href="{{ route('orderTemplate.allOrderTemplates') }}">Toutes les commandes</a></span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end">
                        <img src="{{asset('assets/images/icon-foil.png')}}" alt="" class="img-fluid" />
                    </div>
                    <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Mes commandes <b>{{ $dashboard['orderCnt'] }}</b></h5>
                    <p class="mb-0 text-muted">
                        <span class="text-nowrap text-success "><a href="{{ route('order.index') }}">Toutes mes commandes</a></span>
                    </p>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="header-title mb-3">Commandes (derniers 36 mois)</h4>
                    <div dir="ltr">
                        <div id="messages-chart" class="apex-charts" data-colors="#727cf5,#e3eaef"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>


</div>
<!-- container -->
@endsection

@section('script-bottom')
    <!-- third party js -->
    <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/libs/admin-resources/admin-resources.min.js')}}"></script>
    <!-- third party js ends -->

    <!-- demo app -->
    <script>

        var colors = ["#727cf5", "#e3eaef"];
        var dataColors = $("#messages-chart").data('colors');

        if (dataColors) {
            colors = dataColors.split(",");
        }




        var options = {
            chart: {
                height: 257,
                type: 'bar',
                stacked: true
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    //columnWidth: '20%'
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            zoom: {
                enabled: false
            },
            legend: {
                show: false
            },
            colors: colors,
            yaxis: {
                labels: {
                    offsetX: -15
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function formatter(val) {
                        return val + " messages";
                    }
                }
            }
        };


        var dataArrayMessages = {
            series: [ {
                data: {!!  json_encode($dashboard['chartDataByMonth']['values']) !!} ,
                name: 'messages',
                showInLegend: false,
            } ],
            xaxis: {
                categories: {!! json_encode($dashboard['chartDataByMonth']['dates'])   !!}  ,
                axisBorder: {
                    show: false
                }
            },
            tooltip: {
                y: {
                    formatter: function formatter(val) {
                        return val + " commandes";
                    }
                }
            }
        };


        var chart = new ApexCharts(document.querySelector("#messages-chart"), { ...options, ...dataArrayMessages });

        chart.render();


    </script>
    <!-- end demo js-->
@endsection
