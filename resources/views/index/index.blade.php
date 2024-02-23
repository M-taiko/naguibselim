@extends('layouts.master')
@section('title')
    لوحه التحكم - برنامج  إدارة  زكاة المال
@endsection
@section('css')
    <!--  Owl-carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{ URL::asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">مرحبا {{ Auth::user()->name }} اهلا بك من جديد</h2>
                <p class="mg-b-0">العهدة الخاصه بك {{Auth::user()->balance}} جنيه </p>
            </div>
        </div>
        <div class="main-dashboard-header-right">



        </div>
    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
    @can('إداره')
        <!-- row -->
        <div class="row row-sm">
            <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card ">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            {{-- <h6 class="mb-3 tx-12 "> اجمالي فواتير وارده من الموردين</h6> --}}
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <!-------------------------------------------------------->
                                    <!-------------------------------------------------------->
                                    {{-- <canvas id="supplierChart" width="300" height="300"></canvas> --}}
                                    <!-------------------------------------------------------->
                                    <!-------------------------------------------------------->
                                    <!-------------------------------------------------------->

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card t">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            {{-- <h6 class="mb-3 tx-12 "> اجمالي دفعات الموردين </h6> --}}
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <!----------------------------------------------------------->
                                <!----------------------------------------------------------->
                                {{-- <canvas id="supplierTransactionsChart" width="300" height="300"></canvas> --}}
                                <!----------------------------------------------------------->
                                <!----------------------------------------------------------->

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card ">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            {{-- <h6 class="mb-3 tx-12 ">اجمالي ارصدة الموردين</h6> --}}
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <!----------------------------------------------------------->
                                    <!----------------------------------------------------------->
                                    {{-- <canvas id="supplierBalanceChart" width="300" height="300"></canvas> --}}

                                    <!----------------------------------------------------------->
                                    <!----------------------------------------------------------->
                                </div>
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <!-- row closed -->

        <!--------------------------------------------->

        <div class="row row-sm">
            <div class="col-md-12 col-lg-12 ">
                <div class="card">
                    <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-0">احصائيه المنافذ</h4>
                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                        </div>
                        {{-- <p class="tx-12 text-muted mb-0">رسم بياني يوضح توريدات المنافذ</p> --}}
                    </div>
                    <div class="card-body" style="width:100%">





                        {{-- <canvas id="outletTransactionsStats" width="500" height="200"></canvas> --}}


                    </div>
                </div>
            </div>
        </div>
    @endcan


    <!--------------------------------------------->
    <!-- row opened -->
    
 
    <!-- Container closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Moment js -->
    <script src="{{ URL::asset('assets/plugins/raphael/raphael.min.js') }}"></script>
    <!--Internal  Flot js-->
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ URL::asset('assets/js/dashboard.sampledata.js') }}"></script>
    <script src="{{ URL::asset('assets/js/chart.flot.sampledata.js') }}"></script>
    <!--Internal Apexchart js-->
    <script src="{{ URL::asset('assets/js/apexcharts.js') }}"></script>
    <!-- Internal Map -->
    <script src="{{ URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal-popup.js') }}"></script>
    <!--Internal  index js -->
    <script src="{{ URL::asset('assets/js/index.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.vmap.sampledata.js') }}"></script>














@endsection
