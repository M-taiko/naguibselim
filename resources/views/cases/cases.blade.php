@extends('layouts.master')

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
@section('title')
    الحالات
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">تنظيم وإداره</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    الحالات</span>

            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!------------------------------------------->
    @if (session()->has('Add'))
        <br>
        <div class="alert alert-success alert-dismissible fade show " rol="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    @if (session()->has('Error'))
        <br>
        <div class="alert alert-danger alert-dismissible fade show " rol="alert">
            <strong>{{ session()->get('Error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    @if (session()->has('edit'))
        <br>
        <div class="alert alert-warning alert-dismissible fade show " rol="alert">
            <strong>{{ session()->get('edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    @if (session()->has('delete'))
        <br>
        <div class="alert alert-danger alert-dismissible fade show " rol="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!------------------------------------------->
    <!-- row -->
    <div class="row">





        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">جدول</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>

                    </div>
                    <p class="tx-12 tx-gray-500 mb-2"> الحالات</p>
                </div>

                <div class="col-sm-6 col-md-4 col-xl-3">
                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal"
                        href="#modaldemo8">اضافه حالة </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="cases" class="table  text-center">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0"> اسم الحالة </th>
                                    <th class="border-bottom-0"> عنوان الحاله </th>
                                    <th class="border-bottom-0">سن الحالة </th>
                                    <th class="border-bottom-0"> رقم هاتف الحالة </th>
                                    <th class="border-bottom-0"> الحالة الإجتماعية للحالة </th>
                                    <th class="border-bottom-0">الباحث الإجتماعي للحالة </th>
                                    <th class="border-bottom-0"> الحاله تابعة لـ </th>
                                    <th class="border-bottom-0"> الحي </th>
                                    <th class="border-bottom-0"> المحافظة </th>
                                    <th class="border-bottom-0"> وصف السكن </th>
                                    <th class="border-bottom-0"> وصف الحالة </th>
                                    <th class="border-bottom-0"> دخل الحالة </th>
                                    <th class="border-bottom-0"> مبلغ المساعدة </th>
                                    <th class="border-bottom-0"> تاريخ استلام الحالة </th>
                                    <th class="border-bottom-0"> تاريخ مساعدة الحالةالحاله تابعة لـ </th>
                                    <th class="border-bottom-0"> تاريخ البحث </th>
                                    <th class="border-bottom-0"> ماوصلت الية الحالة </th>
                                    <th class="border-bottom-0"> غير عاجلة / عاجله </th>
                                    <th class="border-bottom-0"> ملاحظات </th>
                                    <th class="border-bottom-0"> نوع الحالة </th>
                                    <th class="border-bottom-0"> خيارات </th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- edit -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">تعديل الحالة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action="cases/update" method="post" autocomplete="off">
                            {{ method_field('patch') }}
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="">
                                <label for="schoolName" class="col-form-label">اسم الحالة:</label>
                                <input class="form-control" name="name" id="name" type="text" required />
                            </div>
                            <div class="form-group">
                                <label for="address" class="col-form-label"> عنوان الحالة:</label>
                                <input class="form-control" id="address" name="address" type="text" required />
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">تاكيد</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- edit -->

        <!-- delete -->
        <div class="modal" id="modaldemo9">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">حذف الحالة</h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="cases/destroy " method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>هل انت متاكد من عملية الحذف ؟</p><br>
                            <input type="hidden" name="id" id="id" value="">
                            <input class="form-control" name="name" id="name" type="text" readonly>
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

        <!-- Basic modal -->
        <div class="modal" id="modaldemo8">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">اضافة حالة جديده </h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('cases.store') }}" method="post">
                            {{ csrf_field() }}



                            <div class="row">
                                <div class="col">

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="name">اسم الحالة</span>
                                        </div>
                                        <input type="text" class="form-control" name="name" aria-label="Default"
                                            aria-describedby="name">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="address">عنوان الحالة</span>
                                        </div>
                                        <input type="text" class="form-control" name="address" aria-label="Default"
                                            aria-describedby="address">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="age">سن الحالة</span>
                                        </div>
                                        <input type="number" class="form-control" name="age" aria-label="Default"
                                            aria-describedby="age">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="phone">رقم هاتف الحالة</span>
                                        </div>
                                        <input type="number" class="form-control" name="phone" aria-label="Default"
                                            aria-describedby="phone">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="maritalStatus">الحالة الإجتماعية
                                                للحالة</span>
                                        </div>
                                        <select class="form-control" name="maritalStatus">
                                            <option value="اعزب\ه">اعزب </option>
                                            <option value="متزوج\ه"> متزوج \ ه</option>
                                            <option value="ارمل\ه"> ارمل \ه</option>
                                            <option value="مطلق\ه">مطلق \ه</option>
                                       
                                        </select>
                                        {{-- <input type="text" class="form-control" name="maritalStatus"
                                            aria-label="Default" aria-describedby="maritalStatus"> --}}
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="researcher">الباحث الإجتماعي للحالة</span>
                                        </div>
                                        <input type="text" class="form-control" name="researcher"
                                            aria-label="Default" aria-describedby="researcher">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="BelongesTo">الحاله تابعة لـ</span>
                                        </div>
                                        <input type="text" class="form-control" name="BelongesTo"
                                            aria-label="Default" aria-describedby="BelongesTo">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="Neighborhood">الحي</span>
                                        </div>
                                        <input type="text" class="form-control" name="Neighborhood"
                                            aria-label="Default" aria-describedby="Neighborhood">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="governorate">المحافظة</span>
                                        </div>
                                        <input type="text" class="form-control" name="governorate"
                                            aria-label="Default" aria-describedby="governorate">
                                    </div>


                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="NSamount">مبلغ المساعدة </span>
                                        </div>
                                        <input type="number" class="form-control" name="NSamount" aria-label="Default"
                                            aria-describedby="NSamount">
                                    </div>

                                    <!--end of col-->
                                </div>
                                <div class="col">


                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="DescriptionOfTheCase">وصف الحالة </span>
                                        </div>
                                        <input type="text" class="form-control" name="DescriptionOfTheCase"
                                            aria-label="Default" aria-describedby="DescriptionOfTheCase">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="income">دخل الحالة </span>
                                        </div>
                                        <input type="number" class="form-control" name="income" aria-label="Default"
                                            aria-describedby="income">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="DescriptionOfTheHouse">وصف السكن </span>
                                        </div>
                                        <input type="text" class="form-control" name="DescriptionOfTheHouse"
                                            aria-label="Default" aria-describedby="DescriptionOfTheHouse">
                                    </div>



                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="SearchHistory">تاريخ البحث </span>
                                        </div>
                                        <input type="date" class="form-control" name="SearchHistory"
                                            aria-label="Default" aria-describedby="SearchHistory">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="receivedDate">تاريخ استلام الحالة </span>
                                        </div>
                                        <input type="date" class="form-control" name="receivedDate"
                                            aria-label="Default" aria-describedby="receivedDate">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="HelpHistory">تاريخ مساعدة الحالة </span>
                                        </div>
                                        <input type="date" class="form-control" name="HelpHistory"
                                            aria-label="Default" aria-describedby="HelpHistory">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="situation"> ماوصلت الية الحالة </span>
                                        </div>
                                        <input type="text" class="form-control" name="situation" aria-label="Default"
                                            aria-describedby="situation">
                                    </div>


                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="IsUrgent"> غير عاجلة / عاجله </span>
                                        </div>
                                        <select class="form-control" name="IsUrgent">
                                            <option value="عاجلة"> عاجلة</option>
                                            <option value="غير عاجلة"> غير عاجلة</option>
                                        </select>
                                        {{-- <input type="text" class="form-control" name="IsUrgent" aria-label="Default"  aria-describedby="IsUrgent"> --}}
                                    </div>


                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="StatusType"> نوع الحالة </span>
                                        </div>
                                        <select class="form-control" name="StatusType">
                                            <option value="مساعدة ماديه"> مساعدة ماديه</option>
                                            <option value="اجهزه تعويضية"> اجهزه تعويضية</option>
                                            <option value="علاج"> علاج</option>
                                            <option value="زواج"> زواج</option>
                                            <option value="غارمين"> غارمين</option>
                                            <option value="عمليات"> عمليات</option>
                                        </select>
                                        {{-- <input type="text" class="form-control" name="IsUrgent" aria-label="Default"  aria-describedby="IsUrgent"> --}}
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="notes"> ملاحظات </span>
                                        </div>
                                        <textarea class="form-control" name="notes" aria-label="Default" aria-describedby="notes" rows="3"></textarea>
                                    </div>

                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" type="submit">حفظ حالة جديد </button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">اغلاق</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Basic modal -->
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

    <script>
        $('#exampleModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var address = button.data('address')


            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #address').val(address);

        })
    </script>


    <script>
        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id');
            var name = button.data('name');
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
        })
    </script>
@endsection
@push('datatable')
    <script>
        $(document).ready(function() {
            var table = $('#cases').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'print'
                ],
                ordering: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('cases.getCasesTable') }}", // Ensure the route name is correct

                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'age',
                        name: 'age'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'maritalStatus',
                        name: 'maritalStatus'
                    },
                    {
                        data: 'researcher',
                        name: 'researcher'
                    },
                    {
                        data: 'BelongesTo',
                        name: 'BelongesTo'
                    },
                    {
                        data: 'Neighborhood',
                        name: 'Neighborhood'
                    },
                    {
                        data: 'governorate',
                        name: 'governorate'
                    },
                    {
                        data: 'DescriptionOfTheHouse',
                        name: 'DescriptionOfTheHouse'
                    },
                    {
                        data: 'DescriptionOfTheCase',
                        name: 'DescriptionOfTheCase'
                    },
                    {
                        data: 'income',
                        name: 'income'
                    },
                    {
                        data: 'NSamount',
                        name: 'NSamount'
                    },
                    {
                        data: 'SearchHistory',
                        name: 'SearchHistory'
                    },
                    {
                        data: 'receivedDate',
                        name: 'receivedDate'
                    },
                    {
                        data: 'HelpHistory',
                        name: 'HelpHistory'
                    },
                    {
                        data: 'situation',
                        name: 'situation'
                    },
                    {
                        data: 'IsUrgent',
                        name: 'IsUrgent'
                    },
                    {
                        data: 'notes',
                        name: 'notes'
                    },
                    {
                        data: 'StatusType',
                        name: 'StatusType'
                    },
                 
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });
        });
    </script>
@endpush
