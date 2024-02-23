@extends('layouts.master')
@section ('title')
لوحه التحكم - برنامج  إدارة  زكاة المال
@endsection
@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="left-content">
						<div>
						  <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">مرحبا  {{Auth::user()->name}} اهلا بك من جديد</h2>
						  <p class="mg-b-0">نظرة سريعة الحركات</p>
						</div>
					</div>
					<div class="main-dashboard-header-right">
						
					
					
					</div>
				</div>
				<!-- /breadcrumb -->
@endsection
@section('content')
@can('إداره')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-primary-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">  اجمالي الإستلامات علي مستوي جميع المخازن بالكارتونه</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">
											{{
												number_format(
												App\Models\transaction::where('ordertype','=','استلام من مورد')->sum('quantity') - 
												App\Models\transaction::where('ordertype','=','مرتجع الي مورد')->sum('quantity'),0)
											}}
											كارتونة
											<br>
											@foreach($allproducts as $allproduct)
												{{number_format($allproduct->total_Meal)}} وجبه
											@endforeach
												
											</h4>
											<br>
											<h6 class="mb-0 tx-12 text-white op-7"> 
											
											 - بإجمالي عدد  {{number_format(App\Models\transaction::where('ordertype','=','استلام من مورد')->count('quantity'),0)}} حركه  استلام من  المصنع  
											<br>
											- بإجمالي عدد  {{number_format(App\Models\transaction::where('ordertype','=','مرتجع الي مورد')->count('quantity'),0)}} حركه  مرتجع الي  المصنع 

											 </h6>
										
										</div>
									
									</div>
								</div>
							</div>
							<span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
						</div>
					</div>
					
					<div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-danger-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white"> اجمالي المنصرف  علي مستوي جميع المخازن </h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">
											
											@foreach($outproducts as $outproduct)
												{{number_format($outproduct->total_Box)}} كارتونه
												<br>
												{{number_format($outproduct->total_Meal)}} وجبه

											@endforeach
										
											
											
											</h4>
											<br>
											<p class="mb-0 tx-12 text-white op-7"> 
											
											

										بإجمالي عدد {{number_format(App\Models\transaction::where('ordertype','=','صرف الي مدارس')->count('quantity'),0)}} حركه  صرف الي مدارس  
											 <br>و 
											بإجمالي عدد {{number_format(App\Models\transaction::where('ordertype','=','صرف الي متعهد')->count('quantity'),0)}} حركه  صرف الي متعهد 

											 </p>
										
									
										</div>
											 	<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
											<span class="text-white op-7">
											<!--- النسبه المئويه--->
										 	{{ round (
											(App\Models\transaction::where('ordertype','=','صرف الي مدارس')->sum('quantity') +
											App\Models\transaction::where('ordertype','=','مرتجع الي مورد')->sum('quantity')+
											App\Models\transaction::where('ordertype','=','صرف الي متعهد')->sum('quantity') ) /
											App\Models\transaction::where('ordertype','=','استلام من مورد')->sum('quantity') * 100
											
											, 3)  
											 }} %
											
											
											</span>
										</span>
										
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline2" class="pt-2">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
						</div>
					</div>
					<div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-success-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">اجمالي الأرصده   المتاحه بالمخازن</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white text-center">
											@foreach($avaliableProducts as $avaliableProduct)
												{{number_format($avaliableProduct->total_Box)}} كارتونه
											@endforeach
											
											<br>
											@foreach($avaliableProducts as $avaliableProduct)
												{{number_format($avaliableProduct->total_Meal)}} وجبه
											@endforeach
												
											</h4>
											<br>
											<br>
				
										</div>
										
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
						</div>
					</div>
					
				</div>
				<!-- row closed -->

<!--------------------------------------------->

<div class="row row-sm">
					<div class="col-md-12 col-lg-12 ">
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

@endcan


<!--------------------------------------------->
				<!-- row opened -->
				@can('استلام من مخزن رئيسي')
				
					<div calss="row">
					
						<div class="card-body">
							<div class='col'>
								<div class="card">
									<div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
										<h4 class="card-title mb-0">رصيد مخزن || {{Auth::user()->whearhousname}} ||</h4>
									</div>
									<br>
									<h3 class="text-center">الكميه بالوجبه</h3>
									<table  class="table key-buttons text-md-nowrap text-center">
											<thead>
												<tr>
													@foreach($details as $product  )
														<td> {{$product->itemID}} </td>
													@endforeach
												</tr>
											</thead>
											<tbody>
												<tr>
												@foreach($details as $product  )
													<td> {{number_format($product->total_Meal)}} </td>
												@endforeach												
												</tr>
											</tbody>
									</table>

									<h3 class="text-center">الكميه بالكارتونه</h3>
									<table  class="table key-buttons text-md-nowrap text-center">
											<thead>
												<tr>
													@foreach($details as $product)
														<td> {{$product->itemID}} </td>
													@endforeach
												</tr>
											</thead>
											<tbody>
												<tr>
												@foreach($details as $product  )
													<td> {{number_format($product->TOTAL_BOX)}} </td>
												@endforeach												
												</tr>
											</tbody>
									</table>

								<div>
							</div>
						</div>
					</div>

@endcan




		
				<!-- row closed -->

<!------------------------------------------------------------->




		

			
				<!-- /row -->
			</div>
		</div>
		<!-- Container closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<!--Internal  Flot js-->
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
<script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
<!-- Internal Map -->
<script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
<!--Internal  index js -->
<script src="{{URL::asset('assets/js/index.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>	
@endsection