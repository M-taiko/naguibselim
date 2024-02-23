@extends('layouts.master')
@section('title')
 تقرير تفصيلي     
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
							<h4 class="content-title mb-0 my-auto">  التقارير </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تقرير تفصيلي بالأيام  </span>
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
                                <form action="/detailedreport/search" method="POST" role="search" autocomplete="off">
                                    {{ csrf_field() }}
                        
                        
                                    <div class="col-lg-3">
                                        <label class="rdiobox">
                                            <input checked name="rdio" type="radio" value="1" id="type_div"> <span>بحث بإسم المخزن والتاريخ</span></label>
                                    </div>


                                    <div class="row">

                                  
                        
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
                                   
                                
                                            <table id="itemReport" class="table display display key-buttons text-md-nowrap text-center">
                                                <thead>
                                                    <tr>
                                        <th class="border-bottom-0">#</th>
                                        <td><b> التاريخ</b></td>
                                        <td><b>اسم المخزن</b></td>
                                        <td><b> اسم الصنف </b></td>
                                        
                                        <td><b>استلام من مورد</b></td>
                                        <td><b>صرف الي متعهد</b></td>
                                        <td><b> مرتجع لمورد</b></td>
                                        <td><b> صرف مباشر للمدارس</b></td>
                                        <td><b>مرتجع من متعهد </b></td>
                                        <td><b>صرف الي مخزن رئيسي (تحويل)</b></td>
                                        <td><b>استلام من مخزن رئيسي (تحويل)</b></td>
                                        <td><b> مرتجع الي مخزن رئيسي</b></td>
                                        <td><b> الرصيد </b></td>
										
											</tr>
										</thead>
										<tbody> 
                                           <?php 
                                                $encrement = 0;
                                                $totalone = 0;
                                                $totaltwo = 0;
                                                $totalthree = 0;
                                                $totalfour = 0;
                                                $totalfive = 0;
                                                $totalsix = 0;
                                                $totalseven = 0;
                                                $totaleight = 0;
                                                $Grandtotal = 0;
                                                ?>
											@foreach($details as $invoice)

                                            <?php
                                                $encrement ++ ;
                                                $totalone +=$invoice->FactoryIN;
                                                $totaltwo+=$invoice->ContractorOUT;
                                                $totalthree+=$invoice->FactoryOUT;
                                                $totalfour+=$invoice->schoolsOUT;
                                                $totalfive+=$invoice->ContractorIN;
                                                $totalsix+=$invoice->outToMainWhearhouse;
                                                $totalseven+=$invoice->inFromMainWhearhouse;
                                                $totaleight+=$invoice->returnfromcontractor;
                                                
                                                $Grandtotal+=$invoice->Total;
                                                ?>
                                            <tr>
                                                
                                                <td> {{$encrement }}</td>
                                                <td> {{ $invoice->date}}</td>
                                                <td> {{ $invoice->whearhousID}}</td>
                                                <td> {{ $invoice->itemID}}</td>
                                                <td> {{ $invoice->FactoryIN}}</td>
                                                <td> {{ $invoice->ContractorOUT}}</td>
                                                <td> {{ $invoice->FactoryOUT}}</td>
                                                <td> {{ $invoice->schoolsOUT}}</td>
                                                <td> {{ $invoice->ContractorIN}}</td>
                                                <td> {{ $invoice->outToMainWhearhouse}}</td>
                                                <td> {{ $invoice->inFromMainWhearhouse}}</td>
                                                <td> {{ $invoice->returnfromcontractor}}</td>
                                                <td> {{ $invoice->Total}}</td>
                                           
                                            </tr>
                                            
											@endforeach
											
											
										</tbody>
										<tfoot>
                                          <tr class="bg-info bg-gradient">
                                                <td></td>
                                                <td></td>
                                                <td><b> الإجمالي بالكارتونه </b></td>
                                                <td></td>
                                                <td> {{ $totalone}}</td>
                                                <td> {{ $totaltwo}}</td>
                                                <td> {{ $totalthree}}</td>
                                                <td> {{ $totalfour}}</td>
                                                <td> {{ $totalfive}}</td>
                                                <td> {{ $totalsix}}</td>
                                                <td> {{ $totalseven}}</td>
                                                <td> {{ $totaleight}}</td>
                                                <td> {{ $Grandtotal}}</td>
                                            </tr>
											  <tr class="bg-primary bg-gradient">
                                                    <td></td>
                                                <td></td>
                                                   <td><b> الإجمالي بالوجبه </b></td>
                                                <td></td>
                                                <td> {{ $totalone * 120 /2}}</td>
                                                <td> {{ $totaltwo*120 / 2}}</td>
                                                <td> {{ $totalthree*120 / 2}}</td>
                                                <td> {{ $totalfour*120 / 2}}</td>
                                                <td> {{ $totalfive*120 / 2}}</td>
                                                <td> {{ $totalsix*120 / 2}}</td>
                                                <td> {{ $totalseven*120 / 2}}</td>
                                                <td> {{ $totaleight*120 / 2}}</td>
                                                <td> {{ $Grandtotal*120 / 2}}</td>
                                        
                                           
                                            </tr>
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