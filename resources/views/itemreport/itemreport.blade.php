@extends('layouts.master')
@section('title')
تقارير  حركة الصنف
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
							<h4 class="content-title mb-0 my-auto"> إدارة الإمداد </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تقارير حركة صنف</span>
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
								<p class="tx-12 tx-gray-500 mb-2">حركات الصنف</p>
                                <form action="/itemreport/search" method="POST" role="search" autocomplete="off">
                                    {{ csrf_field() }}
                        
                        
                                    <div class="col-lg-3">
                                        <label class="rdiobox">
                                            <input checked name="rdio" type="radio" value="1" id="type_div"> <span>بحث بإسم المخزن والتاريخ</span></label>
                                    </div>


                                    <div class="row">
                        
                                        <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="type">
                                            <p class="mg-b-10"> ابحث عن طريق اسم المخزن</p
                                                ><select class="form-control select2 js-example-basic-single" name="whearhouse"
                                                required>
                                                <option value="" selected>
                                                    {{ $type ?? 'اختر اسم المخزن' }}
                                                </option>
                        
                                                <?php
                                                $mainwhearhouses = DB::table('main__whearhouses')->select('id','WhearHouseName')->get();
                                                foreach ($mainwhearhouses as $mainwhearhouse)
                                                echo "<option value='" . $mainwhearhouse->WhearHouseName ."' > $mainwhearhouse->WhearHouseName </option>";   
                                           ?>
                        
                                            </select>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="type">
                                            <p class="mg-b-10">    اسم الصنف</p
                                                ><select class="form-control select2" name="item"
                                                required>
                                                <option value="" selected>
                                                    {{ $type ?? 'اختر اسم الصنف' }}
                                                </option>
                        
                                                <?php
                                                $products = DB::table('products')->select('id','itemName')->get();
                                                foreach ($products as $product)
                                                echo "<option value='" . $product->itemName ."' > $product->itemName </option>";   
                                           ?>
                        
                                            </select>
                                        </div>
                                        <!-- col-4 -->
                                        <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="type">
                                            <p class="mg-b-10">     نوع المعامله </p
                                                ><select class="form-control select2" name="ordertype"
                                                >
                                                <option value="" selected>
                                                    {{ $type ?? 'اختر نوع المعامله ' }}
                                                </option>
                                                <option value="استلام من مورد">استلام من مصنع</option>
                                                <option value="صرف مباشر للمدارس">صرف مباشر للمدارس</option>
                                                <option value="استلام من مخزن رئيسي">استلام من مخزن رئيسي</option>
                                                <option value="صرف لمتعهد">صرف لمتعهد</option>
                                                <option value="مرتجع لمورد">مرتجع لمورد</option>
                                                <option value="مرتجع من متعهد">مرتجع من متعهد</option>
                                                <option value="صرف لمخزن رئيسي">تحويل لمخزن رئيسي</option>

                                                
                                            
                        
                                            </select>
                                        </div><!-- col-4 -->
                        
                        
                        <br></div>
                        <div class="row">
                                        <div class="col-lg-5" id="start_at">
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
                        
                                        <div class="col-lg-5" id="end_at">
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



                                    @if (isset($details))
                                   
                                
                                            <table id="itemReport" class="table display display key-buttons text-md-nowrap text-center">
                                                <thead>
                                                    <tr>
                                                        <th class="border-bottom-0">#</th>
												<th class="border-bottom-0">اسم المخزن</th>
												<th class="border-bottom-0">نوع الإذن</th>
												<th class="border-bottom-0">الكميه</th>
												<th class="border-bottom-0">رقم الإذن</th>
												<th class="border-bottom-0">إسم الصنف</th>
												<th class="border-bottom-0">تاريخ الإذن</th>
												<th class="border-bottom-0">جهة الإستلام</th>
												<th class="border-bottom-0">جهة الصرف</th>
										
											</tr>
										</thead>
										<tbody> 
                                           <?php $quantity = 0 ; ?>
											@foreach($details as $invoice)
                                        <?php   $quantity +=$invoice->quantity ?>
                                            
                                            <tr>
                                                
                                                <td> {{ $invoice->id}}</td>
                                                <td> {{ $invoice->whearhousID}}</td>
                                                <td> {{ $invoice->ordertype}}</td>
                                                <td> {{ $invoice->quantity}}</td>
                                                <td> {{ $invoice->orderID}}</td>
                                                <td> {{ $invoice->itemID}}</td>
                                                <td> {{ $invoice->date}}</td>
                                                <td> {{ $invoice->factoryName}}</td>
                                                <td> {{ $invoice->contractor}}</td>
                                           
                                            </tr>
                                            
											@endforeach
											
											
										</tbody>
										<tfoot>
                                            <th class="border-bottom-0 bg-dark"></th>
                                            <th class="border-bottom-0 bg-dark"></th>
                                            <th class="border-bottom-0 bg-success">الإجمالي </th>

                                            <th class="border-bottom-0 bg-success">{{$quantity}}</th>
                                            
                                            <th class="border-bottom-0 bg-dark"></th>
                                            <th class="border-bottom-0 bg-dark"></th>
                                            <th class="border-bottom-0 bg-dark"></th>
                                            <th class="border-bottom-0 bg-dark"></th>
                                            <th class="border-bottom-0 bg-dark"></th>
                                        </tfoot>
									</table>
                              
                              

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
				   <h6 class="modal-title">حذف الإذن</h6><button aria-label="Close" class="close" data-dismiss="modal"
																  type="button"><span aria-hidden="true">&times;</span></button>
			   </div>
			   <form action="transaction/destroy " method="post">
				   {{method_field('delete')}}
				   {{csrf_field()}}
				   <div class="modal-body">
					   <p>هل انت متاكد من عملية حذف الإذن رقم  ؟</p><br>
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
    $('#itemReport').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy',  'excel' ,'print','pageLength', 'colvis',
        ],
       
    } );
} );

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