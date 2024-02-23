@extends('layouts.master')
@section('title')
    تقارير موردين
@stop
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Owl Carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <!---Internal  Multislider css-->
    <link href="{{ URL::asset('assets/plugins/multislider/multislider.css') }}" rel="stylesheet">
    <!--- Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">  برنامج  إدارة  زكاة المال </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تقارير </span>
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
                        <h4 class="card-title mg-b-0">تقرير</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-2">الموردين</p>
                    <form action="/Supplier-Payment-report" method="get" role="search" autocomplete="off">
                        {{ csrf_field() }}


                        <div class="col-lg-3">
                            <label class="rdiobox">
                                <input checked name="rdio" type="radio" value="1" id="type_div"> <span>بحث بإسم
                                    المورد والتاريخ</span></label>
                        </div>




                        <div class="row">

                            <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="type">
                                <p class="mg-b-10"> ابحث عن طريق اسم المورد</p><select
                                    class="form-control select2 js-example-basic-single" name="supplier" required>
                                    <option value="" selected>
                                        {{ $type ?? 'اختر اسم المورد' }}
                                    </option>

                                    <?php
                                    $outlets = DB::table('suppliers')
                                        ->select('id', 'name')
                                        ->get();
                                    foreach ($outlets as $outlet) {
                                        echo "<option value='" . $outlet->id . "' > $outlet->name </option>";
                                    }
                                    ?>

                                </select>
                            </div><!-- col-4 -->




                            <div class="col-lg-3" id="start_at">
                                <label for="exampleFormControlSelect1">من تاريخ</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div><input class="form-control fc-datepicker" value="{{ $start_at ?? '' }}"
                                        name="start_at" placeholder="YYYY-MM-DD" type="text">
                                </div><!-- input-group -->
                            </div>

                            <div class="col-lg-3" id="end_at">
                                <label for="exampleFormControlSelect1">الي تاريخ</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div><input class="form-control fc-datepicker" name="end_at"
                                        value="{{ $end_at ?? '' }}" placeholder="YYYY-MM-DD" type="text">
                                </div><!-- input-group -->
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-sm-1 col-md-1">
                                <button class="btn btn-primary btn-block">بحث</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">




                    

                        @if (isset($result))

                            <div class="row">
                                <div class="col">
                                    <table  class="table display display table-success key-buttons text-md-nowrap text-center">
                                      
                                    </table>

                                    <table id="reportTable"
                                    class="table display display  key-buttons text-md-nowrap text-center"
                                       >
                                        <thead>
                                           
                                            <tr>

                                                <th class="border-bottom-0">اسم مورد </th>
                                                <th class="border-bottom-0">النوع</th>
                                                <th class="border-bottom-0"> اسم المنفذ </th>
                                                <th class="border-bottom-0"> المشتريات</th>
                                                <th class="border-bottom-0"> المدفوعات</th>
                                                <th class="border-bottom-0">الرصيد</th>
                                                <th class="border-bottom-0">التاريخ</th>
                                                <th class="border-bottom-0">الوصف</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                         
                                           
                                            @foreach ($result as $record)
                                                <!-- Rows for $all_invoices -->
                                                <tr class="{{ $record->type == 'شراء' ? 'table-success' : ($record->type == 'دفع' ? 'table-danger' : '') }}">
                                                    <!-- Display columns for $all_invoices -->
                                                    <td>{{ $record->name ?? '-----' }}</td>
                                                    <td>{{ $record->type }}</td>
                                                    <td>{{ $record->outlet_name }}</td>
                                                    <td>{{ $record->total_buy }}</td>
                                                    <td>{{ $record->total_recive }}</td>
                                                    <td>{{ $record->Balance }}</td>
                                                    <td>{{ $record->created_at }}</td>
                                                    <td>{{ $record->discription ?? '-----' }}</td>
                                                 
                                                </tr>
                                             
                                            @endforeach




                                        </tbody>

                                       
                                    </table>

                                </div>
                             
@endif
                                 

                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
        <!-- delete -->
        <div class="modal" id="modaldemo9">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">حذف الإذن</h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="transaction/destroy " method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>هل انت متاكد من عملية حذف الإذن رقم ؟</p><br>
                            <input type="text" class="form-control" name="id" id="id" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-danger">تاكيد</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
        <!-- delete -->
        <!--div-->

    </div>
    <!-- /row -->


    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>






    @push('datatable')
        <script>
            var date = $('.fc-datepicker').datepicker({
                dateFormat: 'yy-mm-dd'
            }).val();
        </script>

        <script>
            $(document).ready(function() {
                $('#reportTable').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'print',
                            text: '<i class="fas fa-print"></i> Print',
                            exportOptions: {
                                columns: ':visible'
                            },
                            title: 'Outlet Report',
                        },
                        {
                            extend: 'excel',
                            text: '<i class="far fa-file-excel"></i> Excel',
                            exportOptions: {
                                columns: ':visible'
                            },
                            title: 'Outlet Report',
                        },
                        'colvis'
                    ],
                    colReorder: true,
                    ordering: true,
                    searching: true,
                    columnDefs: [{
                        targets: [6],
                        render: function(data, type, row) {
                            return moment(data).format('YYYY-MM-DD'); 
                        }
                    }]
                });
            });



            $(document).ready(function() {
                $('#lastBalance').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{ }],
                    colReorder: false,
                    ordering: false,
                    searching: false,
                });
            });




            // $(document).ready(function() {
            //     $('#DailyReportTransactions').DataTable({
            //         dom: 'Bfrtip',
            //         buttons: [{
            //                 extend: 'print',
            //                 text: '<i class="fas fa-print"></i> Print',
            //                 exportOptions: {
            //                     columns: ':visible'
            //                 },
            //                 title: 'Outlet Report',
            //             },
            //             {
            //                 extend: 'excel',
            //                 text: '<i class="far fa-file-excel"></i> Excel',
            //                 exportOptions: {
            //                     columns: ':visible'
            //                 },
            //                 title: 'Outlet Report',
            //             },
            //             'colvis'
            //         ],
            //         colReorder: true,
            //         ordering: true,
            //         searching: false,
            //         columnDefs: [{
            //             targets: [4], // Assuming 'created_at' is the 6th column (index 5)
            //             render: function(data, type, row) {
            //                 return moment(data).format(
            //                 'YYYY-MM-DD'); // Adjust the date format as needed
            //             }
            //         }]
            //     });
            // });
        </script>
    @endpush



@endsection
