@extends('layouts.master')
@section('title')
حركات  الصرف والإستلام 
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
            <h4 class="content-title mb-0 my-auto"> إدارة  </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ حركات الصرف واللإستلام</span>
        </div>
    </div>

</div>
<!-- breadcrumb -->
@endsection
@section('content')

@if(session()->has('delete'))
<br>
<div class="alert alert-danger alert-dismissible fade show " rol="alert">
    <strong>{{ session()->get('delete') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@section('content')
<!------------------------------------------->
@if(session()->has('Add'))
<br>
<div class="alert alert-success alert-dismissible fade show " rol="alert">
    <strong>{{ session()->get('Add') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if(session()->has('Error'))
<br>
<div class="alert alert-danger alert-dismissible fade show " rol="alert">
    <strong>{{ session()->get('Error') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif


@if(session()->has('edit'))
<br>
<div class="alert alert-warning alert-dismissible fade show " rol="alert">
    <strong>{{ session()->get('edit') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif




<!-- row -->
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">جدول</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <p class="tx-12 tx-gray-500 mb-2">الحركات</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">




                    <table id="transaction" class="table display key-buttons text-md-nowrap text-center">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">من </th>
                                <th class="border-bottom-0">الي</th>
                                <th class="border-bottom-0">اسم الخزينة</th>
                                <th class="border-bottom-0">نوع العملية</th>
                                <th class="border-bottom-0">الإجمالي</th>
                                <th class="border-bottom-0">الحاله</th>
                                <th class="border-bottom-0">الوصف</th>
                                <th class="border-bottom-0">حالة الطلب</th>
                                <th class="border-bottom-0"> تاريخ الطلب </th>
                                <th class="border-bottom-0"> تاريخ التعديل </th>
                              
                                <th class="border-bottom-0">التحكم </th>
                            </tr>
						
                        </thead>
                        <tbody>



                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/div-->
<!------------qr code genrator---------------------------------->
<!-- Button trigger modal -->




<!---------------------------------------------->






    <!-- delete -->
    @can('التحكم')
    <div class="modal" id="modaldemo9">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف الإذن</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="transaction/destroy " method="post">
                    {{method_field('delete')}}
                    {{csrf_field()}}
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
    @endcan
    <!-- delete -->



    <!-- update -->
    @can('التحكم')
    <div class="modal" id="exampleModal2">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">تعديل حالة الطلب </h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="transaction/destroy " method="post">
                    {{method_field('delete')}}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <p>هل انت متاكد من عملية تعديل الإذن الإذن رقم ؟</p><br>
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
    @endcan
    <!-- update -->

@can('محاسب')
    <!-- send Mony to Representative -->
    <div class="modal" id="sendMonytoRepresentative">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">تعديل حالة الطلب </h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('transaction.account_accept') }}" method="post">
                
                    {{csrf_field()}}
                    <div class="modal-body">
                        <p>هل انت متاكد من عملية تسليم المبلغ الي المندوب  ؟</p><br>
                        <input type="text" class="form-control d-none" name="id" id="id" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">تاكيد</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    @endcan
    <!-- send Mony to Representative -->

@can('مندوب')
    <!-- accept Mony From Accountant -->
    <div class="modal" id="acceptMonyFromAccountant">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">تعديل حالة الطلب </h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('transaction.acceptMonyFromAccountant') }}" method="post">
                
                    {{csrf_field()}}
                    <div class="modal-body">
                        <p>هل انت متاكد من عملية تسلم المبلغ من الخزينة  ؟</p><br>
                        <input type="text" class="form-control d-none" name="id" id="id" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">تاكيد</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    @endcan
    <!-- accept Mony From Accountant -->
    <!--div-->

</div>
<!-- /row -->


<!-- main-content closed -->
@endsection
@section('js')
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

<script>
    $('#exampleModal2').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var theschoolname = button.data('schoolname')
        var theschooladmin = button.data('administration')
        var theschoolstate = button.data('theState')

        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #schoolName').val(theschoolname);
        modal.find('.modal-body #Adminstration').val(theschooladmin);
        modal.find('.modal-body #thestate').val(theschoolstate);
    })

</script>


<script>
    $('#modaldemo9').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var orderiD = button.data('orderiD')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #orderID').val(orderiD);
    })

</script>


@push('datatable')

<script type="text/javascript">
  $(function() {
    var table = $('#transaction').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'print', 'pageLength'
        ],
        ordering: true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('transaction.gettransactionTable') }}",
        columns: [
            { data: 'id', name: 'id' },

            
            { data: 'from_user.name', name: 'from_user.name' ,   defaultContent: ''  } ,  //from
            { data: 'to_user.name',   name: 'to_user.name' ,  defaultContent: '' } , //to 

     



            { data: 'treasury.name', name: 'treasury.name', defaultContent: '' },
            { data: 'transaction_type', name: 'transaction_type' },
            { data: 'amount', name: 'amount' },
            { data: 'cases.name', name: 'cases.name', defaultContent: ''  },
            { data: 'description', name: 'description' },
            { data: 'status', name: 'status' },
            {
                data: 'created_at',
                name: 'created_at',
                render: function(data) {
                    return moment(data).format('YYYY-MM-DD  //  HH:mm:ss');
                }
            },
            {
                data: 'updated_at',
                name: 'updated_at',
                render: function(data) {
                    return moment(data).format('YYYY-MM-DD  //  HH:mm:ss');
                }
            },
            { data: 'action', name: 'action' }
        ],
        columnDefs: [
            {
                targets: 8, // Index of the status column
                render: function(data, type, row, meta) {
                    if (data === 'pending') {
                        return '<button href="#sendMonytoRepresentative"  data-id="' + row.id + '" data-toggle="modal" class="btn btn-sm btn-warning">في انتظار قبول المحاسب</button>';
                    } else if (data === 'prepending') {
                        return '<button href="#acceptMonyFromAccountant"  data-id="' + row.id + '" data-toggle="modal" class="btn btn-sm btn-success">تم  اخراج المال من الخزينة</button>';

                    
                    } else if (data === 'completed') {
                        return '<span class="badge badge-success">تم اكمال العملية</span>';

                    }else {
                        return data;
                    }
                }
            }
        ]
    });
});


</script>


















<script>
    $('#sendMonytoRepresentative').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var orderiD = button.data('orderiD')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #orderID').val(orderiD);
    })


    $('#acceptMonyFromAccountant').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var orderiD = button.data('orderiD')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #orderID').val(orderiD);
    })

</script>
@endpush



@endsection


