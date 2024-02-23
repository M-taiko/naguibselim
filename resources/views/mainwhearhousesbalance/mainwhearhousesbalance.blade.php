@extends('layouts.master')
@section('title')
أرصدة المخازن الرئيسيه
@stop
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!---Internal Owl Carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
<!---Internal  Multislider css-->
<link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
<!--- Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto"> إدارة الإمداد </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ أرصدة المخازن الرئيسيه</span>
        </div>
    </div>

</div>
<!-- breadcrumb -->
@endsection
@section('content')



@section('content')
<!------------------------------------------->








<!-- row -->
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">بحث </h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <p class="tx-12 tx-gray-500 mb-2">أرصدة المخازن الرئيسيه </p>
                <form action="/mainwhearhousesbalance/search" method="POST" role="search" autocomplete="off">
                    {{ csrf_field() }}





                    <div class="row">

                        <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="type">
                            <p class="mg-b-10"> ابحث عن طريق اسم المخزن</p><select class="form-control select2 js-example-basic-single" name="whearhouse" required>
                                <option value="" selected>
                                    {{ $type ?? 'اختر اسم المخزن' }}
                                </option>

                                <?php
                                                $mainwhearhouses = DB::table('main__whearhouses')->select('id','WhearHouseName')->get();
                                                foreach ($mainwhearhouses as $mainwhearhouse)
                                                echo "<option value='" . $mainwhearhouse->WhearHouseName ."' > $mainwhearhouse->WhearHouseName </option>";   
                                           ?>

                            </select>
                            <button class="btn btn-primary btn-block">بحث</button>
                        </div><!-- col-4 -->





                </form>



            </div>

            <div class="card-body">
                <div class="table-responsive">



                    @if (isset($details))


                    <div calss="row">

                        <div class="card-body">
                            <div class='col'>
                                <h2 class=" text-center">رصيد مخزن || {{ $whearhouse }} ||</h2>
                                <div class="card bg-info">
                                    <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                                    </div>
                                    <br>
                                    <h3 class="text-center">الكميه بالوجبه</h3>
                                    <table class="table key-buttons  text-md-nowrap text-center">
                                        <thead>
                                            <tr>
                                                @foreach($details as $product )
                                                <td> {{$product->itemID}} </td>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @foreach($details as $product )
                                                <td> {{number_format($product->total_Meal)}} </td>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                              
                            </div>
                            <div class='col'>
                                 <div class="card bg-primary  ">

                                    <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                                    </div>
                                    <br>
                                    <h3 class="text-center text-light">الكميه بالكارتونه</h3>
                                    <table class="table key-buttons   table-striped text-md-nowrap text-center">
                                        <thead>
                                            <tr>
                                                @foreach($details as $product)
                                                <th class="text-light"> {{$product->itemID}} </th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @foreach($details as $product )
                                                <td> {{number_format($product->TOTAL_BOX)}} </td>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div>
                                    </div>
                                </div>
                                
                              
                            </div>



                            <div class="row row-sm">
                                <div class="col-md-9 col-lg-9">
                                    <div class="card">
                                        <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                                            <div class="d-flex justify-content-between">
                                                <h4 class="card-title mb-0">احصائيه المخازن</h4>
                                                <i class="mdi mdi-dots-horizontal text-gray"></i>
                                            </div>
                                            <p class="tx-12 text-muted mb-0">رسم بياني يوضح المخازن والطاقه الاستيعابيه للمنتجات</p>
                                        </div>
                                        <div class="card-body" style="width:100%">
                                            {!! $chartjs->render() !!}

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /row -->

                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!--/div-->

            <!--div-->

        </div>



        <!-- main-content closed -->
        @endsection
        @section('js')
        <script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
        <!-- Internal Data tables -->
        <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
        <!--Internal  Datatable js -->
        <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
        <!--Internal  Datepicker js -->
        <script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
        <!-- Internal Select2 js-->
        <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
        <!-- Internal Modal js-->
        <script src="{{URL::asset('assets/js/modal.js')}}"></script>






        @push('datatable')

        <script>
            var date = $('.fc-datepicker').datepicker({
                dateFormat: 'yy-mm-dd'
            }).val();

        </script>

        <script>
            $(document).ready(function() {
                $('#itemReport').DataTable({
                    dom: 'Bfrtip'
                    , buttons: [
                        'copy', 'excel', 'print', 'pageLength', 'colvis'
                    , ],

                });
            });

            $(document).ready(function() {

                $('#invoice_number').hide();

                $('input[type="radio"]').click(function() {
                    if ($(this).attr('id') == 'type_div') {
                        $('#invoice_number').hide();
                        $('#type').show();
                        $('#start_at').show();
                        $('#end_at').show();
                    } else {
                        $('#invoice_number').show();
                        $('#type').hide();
                        $('#start_at').hide();
                        $('#end_at').hide();
                    }
                });
            });

        </script>


        @endpush



        @endsection
