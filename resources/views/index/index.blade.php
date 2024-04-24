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

@can('مندوب')

<div class="text-center text-dark">حركات المندوب</div>
<div class="row  card-body bg-white">
    <div class="col-md-4">
        <div class="card bg-success-gradient">
            <div class="card-body text-center">
                <a class="text-dark" href="{{ url('/' . $page='recive') }}">   طلب استلام  نقدية من خزينة 
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-90deg-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.854 14.854a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V3.5A2.5 2.5 0 0 1 6.5 1h8a.5.5 0 0 1 0 1h-8A1.5 1.5 0 0 0 5 3.5v9.793l3.146-3.147a.5.5 0 0 1 .708.708z"/>
                      </svg>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card  bg-info-gradient">
            <div class="card-body text-center">
                <a class="text-dark" href="{{ url('/' . $page='pay') }}">   طلب صرف نقدية من العهدة 
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-90deg-up" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.854 1.146a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L4 2.707V12.5A2.5 2.5 0 0 0 6.5 15h8a.5.5 0 0 0 0-1h-8A1.5 1.5 0 0 1 5 12.5V2.707l3.146 3.147a.5.5 0 1 0 .708-.708z"/>
                      </svg>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-dark">
            <div class="card-body text-center">
                <a class="text-light" href="{{ url('/' . $page='userTransactions') }}"> حركات الإستلام والصرف الخاصه بالمندوب 
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-graph-up-arrow" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M0 0h1v15h15v1H0zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5"/>
                      </svg>
                </a>
            </div>
        </div>
    </div>
</div>

@endcan


@can('محاسب')
<hr width="100%"/>

<div class="text-center text-dark">حركات المحاسب</div>
<div class="row  card-body bg-white">
    <div class="col-md-4">
        <div class="card bg-success-gradient">
            <div class="card-body text-center">
                <a class="text-dark" href="{{ url('/' . $page='reciveTotreasury') }}">   طلب استلام  نقدية الي خزينة  
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-90deg-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.854 14.854a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V3.5A2.5 2.5 0 0 1 6.5 1h8a.5.5 0 0 1 0 1h-8A1.5 1.5 0 0 0 5 3.5v9.793l3.146-3.147a.5.5 0 0 1 .708.708z"/>
                      </svg>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card  bg-info-gradient">
            <div class="card-body text-center">
                <a class="text-dark" href="{{ url('/' . $page='payFromTresury') }}">   طلب صرف نقدية من خزينة   
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-90deg-up" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.854 1.146a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L4 2.707V12.5A2.5 2.5 0 0 0 6.5 15h8a.5.5 0 0 0 0-1h-8A1.5 1.5 0 0 1 5 12.5V2.707l3.146 3.147a.5.5 0 1 0 .708-.708z"/>
                      </svg>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-dark">
            <div class="card-body text-center">
                <a class="text-light" href="{{ url('/' . $page='transaction') }}">  جميع حركات الإستلام والصرف  
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-graph-up-arrow" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M0 0h1v15h15v1H0zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5"/>
                      </svg>
                </a>
            </div>
        </div>
    </div>
</div>



@endcan









    @can('إداره')
        <!-- row -->
        {{-- <div class="row row-sm">
            <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card ">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 "> اجمالي فواتير وارده من الموردين</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <!-------------------------------------------------------->
                                    <!-------------------------------------------------------->
                                    <canvas id="supplierChart" width="300" height="300"></canvas>
                                    <!-------------------------------------------------------->
                                    <!-------------------------------------------------------->
                                    <!-------------------------------------------------------->

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div> --}}

            {{-- <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card t">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 "> اجمالي دفعات الموردين </h6>
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
            </div> --}}
            {{-- <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card ">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 ">اجمالي ارصدة الموردين</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <!----------------------------------------------------------->
                                    <!----------------------------------------------------------->
                                    <canvas id="supplierBalanceChart" width="300" height="300"></canvas>

                                    <!----------------------------------------------------------->
                                    <!----------------------------------------------------------->
                                </div>
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
            </div> --}}

        </div>
        <!-- row closed -->

        <!--------------------------------------------->

        {{-- <div class="row row-sm">
            <div class="col-md-12 col-lg-12 ">
                <div class="card">
                    <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-0"></h4>
                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                        </div>
                        <p class="tx-12 text-muted mb-0">رسم بياني يوضح توريدات المنافذ</p>
                    </div>
                    <div class="card-body" style="width:100%">





                        <canvas id="outletTransactionsStats" width="500" height="200"></canvas>


                    </div>
                </div>
            </div>
        </div> --}}
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
