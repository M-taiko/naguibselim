@extends('layouts.master')
@section('title')
 تقرير حركه مصانع للمخازن    
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
							<h4 class="content-title mb-0 my-auto">  التقارير </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تقرير حركة مصانع للمخازن  </span>
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
								<p class="tx-12 tx-gray-500 mb-2"> مصانع المورده للمخزن</p>
                                <form action="/whearhousfactoryreport/search" method="POST" role="search" autocomplete="off">
                                    {{ csrf_field() }}
                        
                        
                                 


                                    <div class="row">
                                        <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="type">
                                            <p class="mg-b-10"> ابحث عن طريق اسم المخزن</p
                                                ><select class="form-control select2 js-example-basic-single" name="whearhouse"
                                                required>
                                                <option value="{{ $type ?? 'اختر اسم المخزن' }}" selected>
                                                    {{ $type ?? 'اختر اسم المخزن' }}
                                                </option>
                        
                                                <?php
                                                $mainwhearhouses = DB::table('main__whearhouses')->select('id','WhearHouseName')->get();
                                                foreach ($mainwhearhouses as $mainwhearhouse)
                                                echo "<option value='" . $mainwhearhouse->WhearHouseName ."' > $mainwhearhouse->WhearHouseName </option>";   
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



                                    @if (isset($details))
                                   
                                                    <p class="tx-12 text-muted mb-0">   استلامات المصانع لــ {{ $whearhous }}</p>
                                
                                            <table id="itemReport" class="table display display key-buttons text-md-nowrap text-center">
                                                <thead>
                                                    <tr>
                                        <th class="border-bottom-0">#</th>
                                        <td><b>اسم المصنع والصنف</b></td>
                                      
                                        <td><b>استلام من مورد</b></td>
                                        <td><b> مرتجع لمورد</b></td>
                                        <td><b>  الإجمالي</b></td>
											</tr>
										</thead>
										<tbody> 
                                           <?php 
                                                $encrement = 0;
                                              
                                                $the_total_in = 0;
                                                $the_total_out = 0;
                                                $the_Grandtotal = 0;
                                         
                                                ?>
											@foreach($details as $invoice)

                                            <?php
                                                $encrement ++ ;
                                               
                                                $the_total_in+=$invoice->total_in;
                                                $the_total_out+=$invoice->total_out;
                                                $the_Grandtotal+=$invoice->Total;
                                             
                                                ?>
                                            <tr>
                                                
                                                <td> {{$encrement }}</td>
                                                <td> {{ $invoice->factoryName}}</td>
                                               
                                                <td> {{ $invoice->total_in}}</td>
                                                <td> {{ $invoice->total_out}}</td>

                                                <td> {{ $invoice->Total}}</td>
                                           
                                            </tr>
                                            
											@endforeach
											
											
										</tbody>
										<tfoot>
                                          <tr class="bg-info bg-gradient">
                                               
                                                <td></td>
                                                <td><b> الإجمالي بالكارتونه </b></td>
                                             
                                                <td> {{ $the_total_in}}</td>
                                                <td> {{ $the_total_out}}</td>
                                                <td> {{ $the_Grandtotal}}</td>
                                            </tr>


											  <tr class="bg-primary bg-gradient">
                                                    <td></td>
                                                   <td><b> الإجمالي بالوجبه </b></td>
                                               
                                             
                                                <td> {{ $the_total_in * 120 /2}}</td>
                                                <td> {{ $the_total_out*120 / 2}}</td>
                                                <td> {{ $the_Grandtotal*120 / 2}}</td>
                                        
                                           
                                            </tr>
                                        </tfoot>
									</table>
                              <hr>
                                  <div class="row row-sm">
                                        <div class="col-md-9 col-lg-9">
                                            <div class="card">
                                                <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                                                    <div class="d-flex justify-content-between">
                                                        <h4 class="card-title mb-0">احصائيه المصانع</h4>
                                                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                                                    </div>
                                                    <p class="tx-12 text-muted mb-0"> رسم بياني يوضح استلامات المصانع لــ {{ $whearhous }}</p>
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
    $('#itemReport').DataTable( {
        dom: 'PBfrtip',
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