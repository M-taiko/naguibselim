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
المخازن الفرعيه
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">تنظيم وإداره</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  المخازن الفرعيه</span>

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
								<p class="tx-12 tx-gray-500 mb-2">المخازن الفرعيه</p>
							</div>

							<div class="col-sm-6 col-md-4 col-xl-3">
								<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافه مخزن فرعي</a>
							</div>
						
							<div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table key-buttons text-md-nowrap text-center">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>
												<th class="border-bottom-0"> اسم المخزن</th>
												<th class="border-bottom-0">المحافظه التابع لها المخزن</th>
												
												<th class="border-bottom-0">التحكم  </th>
											</tr>
										</thead>
										<tbody>
											<?php $countr = 0 ; ?>
											@foreach($THEsecoundyWhearhouses as $secoundwhearhouse)
											<?php $countr++ ?>
										<tr>
											<td>{{$countr}}</td>
											<td>{{$secoundwhearhouse->secoundryWhearHouseName}} </td>
											<td>{{$secoundwhearhouse->secoundryWhearHouseRigon}}</td>
											<td>
												<a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
												data-id="{{ $secoundwhearhouse->id }}" 
												data-secoundrywhearhousename="{{ $secoundwhearhouse->secoundryWhearHouseName }}"
												data-secoundrywhearhouserigon="{{ $secoundwhearhouse->secoundryWhearHouseRigon }}"
												data-toggle="modal" href="#exampleModal2"
												title="تعديل"><i class="las la-pen fa-2x"></i>
											</a>

											 <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
												data-id="{{ $secoundwhearhouse->id }}"
												data-secoundrywhearhousename="{{ $secoundwhearhouse->secoundryWhearHouseName }}" 
												data-toggle="modal"
												href="#modaldemo9" title="حذف"><i class="las la-trash fa-2x"></i>
											</a>




											</td>
										</tr>
											

											@endforeach	
											
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
								  <h5 class="modal-title" id="exampleModalLabel">تعديل المخزن</h5>
								  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									  <span aria-hidden="true">&times;</span>
								  </button>
							  </div>
							  <div class="modal-body">

								  <form action="secoundy_Whearhouses/update"  method="post" autocomplete="off">
										{{method_field('patch')}}
										{{csrf_field()}}
										<div class="form-group">
											<input type="hidden" name="id" id="id" value="">
											<label for="secoundryWhearHouseName" class="col-form-label">اسم المخزن:</label>
											<input class="form-control" name="secoundrywhearhouseName" id="secoundryWhearHouseName" type="text"  required/>
										</div>
										<div class="form-group">
											<label for="secoundryWhearHouseRigon" class="col-form-label">اسم المحافظه التابع لها المخزن:</label>
											<input class="form-control" id="secoundryWhearHouseRigon" name="secoundrywhearHouserigon"  type="text" required />
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
                                    <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                                                                   type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form action="secoundyWhearhouses/destroy " method="post">
                                    {{method_field('delete')}}
                                    {{csrf_field()}}
                                    <div class="modal-body">
                                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                                        <input type="hidden" name="id" id="id" value="">
                                        <input class="form-control" name="secoundryWhearHouseName" id="secoundryWhearHouseName" type="text" readonly>
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
						<h6 class="modal-title">اضافة مخزن رئيسي </h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<form action="{{route('secoundry_Whearhouses.store')}}" method="post">
							{{csrf_field()}}
						<div class="input-group mb-3">
							<div class="input-group-prepend">
							  <span class="input-group-text"  id="secoundryWhearHouseName">اسم المخزن</span>
							</div>
							<input type="text" class="form-control" name="secoundryWhearHouseName" aria-label="Default" aria-describedby="secoundryWhearHouseName">
						  </div>

						<div class="input-group mb-3">
							<div class="input-group-prepend">
							  <span class="input-group-text"  id="secoundryWhearHouseRigon">اسم المحافظه التابع لها المخزن</span>
							</div>
							<input type="text" class="form-control" name="secoundryWhearHouseRigon" aria-label="Default" aria-describedby="secoundryWhearHouseRigon">
						  </div>
						</div>
						<div class="modal-footer">
							<button class="btn ripple btn-primary" type="submit">حفظ مخزن جديد </button>
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
		var secoundryWhearHouseNameValue = button.data('secoundrywhearhousename')
		var secoundryWhearHouseRigonVlaue = button.data('secoundrywhearhouserigon')
		var modal = $(this)
		modal.find('.modal-body #id').val(id);
		modal.find('.modal-body #secoundryWhearHouseName').val(secoundryWhearHouseNameValue);
		modal.find('.modal-body #secoundryWhearHouseRigon').val(secoundryWhearHouseRigonVlaue);
	})
</script>


<script>
	$('#modaldemo9').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)
		var id = button.data('id')
		var secoundryWhearHouseName = button.data('secoundrywhearhousename')
		var modal = $(this)
		modal.find('.modal-body #id').val(id);
		modal.find('.modal-body #secoundryWhearHouseName').val(secoundryWhearHouseName);
	})
</script>

@endsection