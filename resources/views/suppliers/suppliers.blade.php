@extends('layouts.master')

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
@section('title')
 المناديب 
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">تنظيم وإداره</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/   المناديب</span>

						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
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


	@if(session()->has('delete'))
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
								<p class="tx-12 tx-gray-500 mb-2"> الموردين</p>
							</div>

							<div class="col-sm-6 col-md-4 col-xl-3">
								<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافه  مندوب  جديد</a>
							</div>
						
							<div class="card-body">
								<div class="table-responsive">
									<table id="suppliers" class="table key-buttons text-md-nowrap text-center">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>
												<th class="border-bottom-0"> اسم المندوب</th>
												<th class="border-bottom-0"> كود المندوب</th>
												<th class="border-bottom-0">   رقم هاتف المندوب </th>
												<th class="border-bottom-0">   رصيد </th>
												
												<th class="border-bottom-0">التحكم  </th>
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
								  <h5 class="modal-title" id="exampleModalLabel">تعديل المندوب</h5>
								  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									  <span aria-hidden="true">&times;</span>
								  </button>
							  </div>
							  <div class="modal-body">

								  <form action="suppliers/update"  method="post" autocomplete="off">
										{{method_field('patch')}}
										{{csrf_field()}}
										<div class="form-group">
											<input type="hidden" name="id" id="id" value="">
											<label for="itemName" class="col-form-label">اسم المندوب:</label>
											<input class="form-control" name="name" id="itemName" type="text"  required/>
										</div>
										<div class="form-group">
											<label for="code" class="col-form-label">كود المندوب:</label>
											<input class="form-control" name="code" id="code" type="text"  />
										</div>
										<div class="form-group">
											<label for="itemQuantity" class="col-form-label">رقم هاتف      :</label>
											<input class="form-control" id="itemQuantity" name="description"  type="text" required />
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
                                    <h6 class="modal-title">حذف المورد</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                                                                   type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form action="suppliers/destroy " method="post">
                                    {{method_field('delete')}}
                                    {{csrf_field()}}
                                    <div class="modal-body">
                                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                                        <input type="hidden" name="id" id="id" value="">
                                        <input class="form-control" name="itemName" id="itemName" type="text" readonly>
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
			<div class="modal-dialog" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">اضافة المندوب  جديد </h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<form action="{{route('suppliers.store')}}" method="post">
							{{csrf_field()}}
						<div class="input-group mb-3">
							<div class="input-group-prepend">
							  <span class="input-group-text"  id="itemName">اسم المندوب</span>
							</div>
							<input type="text" class="form-control" name="name" aria-label="Default" aria-describedby="itemName">
						  </div>

						<div class="input-group mb-3">
							<div class="input-group-prepend">
							  <span class="input-group-text"  id="code">كود المندوب</span>
							</div>
							<input type="text" class="form-control" name="code" aria-label="Default" aria-describedby="code">
						  </div>

						

						<div class="input-group mb-3">
							<div class="input-group-prepend">
							  <span class="input-group-text"  id="itemQuantity">رقم هاتف      </span>
							</div>
							<input type="text" class="form-control" name="phone" aria-label="Default" aria-describedby="itemQuantity">
						  </div>
						</div>
						<div class="modal-footer">
							<button class="btn ripple btn-primary" type="submit">حفظ المندوب جديد </button>
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
		var itemName = button.data('name')
		var ItemQuantity = button.data('itemquantity')
		var modal = $(this)
		modal.find('.modal-body #id').val(id);
		modal.find('.modal-body #itemName').val(itemName);
		modal.find('.modal-body #itemQuantity').val(ItemQuantity);
	})
</script>


<script>
	$('#modaldemo9').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)
		var id = button.data('id')
		var itemName = button.data('name')
		var modal = $(this)
		modal.find('.modal-body #id').val(id);
		modal.find('.modal-body #itemName').val(itemName);
	})
</script>

@endsection
@push('datatable')
    <script type="text/javascript">
        $(function() {
            var table = $('#suppliers').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'print'
                ],
                ordering: false,
                processing: true,
                serverSide: true,
                ajax: `{{ Route('suppliers.getsuppliersTable') }}`,

                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'balance',
                        name: 'balance'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },


                ]

            });
        });
    </script>
@endpush
