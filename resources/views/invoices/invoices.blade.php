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
 الفواتير
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">تنظيم وإداره</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/   الفواتير</span>
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
								<p class="tx-12 tx-gray-500 mb-2"> الفواتير</p>
							</div>

							<div class="col-sm-6 col-md-4 col-xl-3">
                                <a class=" btn btn-outline-primary btn-block" href="{{ route('invoices.add_new_invoice') }}">اضافه فاتوره</a>
							</div>
						
							<div class="card-body">
								<div class="table-responsive">
									<table id="products" class="table key-buttons text-md-nowrap text-center">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>
												<th class="border-bottom-0"> اسم المورد</th>
												<th class="border-bottom-0"> اسم المنفذ </th>
												<th class="border-bottom-0"> نوع الفاتوره </th>
												<th class="border-bottom-0">اجمالي سعر الشراء </th>
												<th class="border-bottom-0"> اجمالي الفاتوره </th>
												<th class="border-bottom-0">ربح الفاتوره </th>
												<th class="border-bottom-0"> مدخل البيانات </th>
												<th class="border-bottom-0"> تاريخ الفاتورة </th>
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
								  <h5 class="modal-title" id="exampleModalLabel">تعديل المنتج</h5>
								  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									  <span aria-hidden="true">&times;</span>
								  </button>
							  </div>
							  <div class="modal-body">

								  <form action="products/update"  method="post" autocomplete="off">
										{{method_field('patch')}}
										{{csrf_field()}}
										<div class="form-group">
											<input type="hidden" name="id" id="id" value="">
											<label for="itemName" class="col-form-label">اسم المنتج:</label>
											<input class="form-control" name="name" id="itemName" type="text"  required/>
										</div>
										<div class="form-group">
											<label for="code" class="col-form-label">كود المنتج:</label>
											<input class="form-control" name="code" id="code" type="text"  />
										</div>
										<div class="form-group">
											<label for="itemQuantity" class="col-form-label">وصف المنتج      :</label>
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
                                    <h6 class="modal-title">حذف المنتج</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                                                                   type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form action="invoices/destroy " method="post">
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
						<h6 class="modal-title">اضافة منتج  جديد </h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<form action="{{route('products.store')}}" method="post">
							{{csrf_field()}}
						<div class="input-group mb-3">
							<div class="input-group-prepend">
							  <span class="input-group-text"  id="itemName">اسم المنتج</span>
							</div>
							<input type="text" class="form-control" name="name" aria-label="Default" aria-describedby="itemName">
						  </div>

						<div class="input-group mb-3">
							<div class="input-group-prepend">
							  <span class="input-group-text"  id="code">كود المنتج</span>
							</div>
							<input type="text" class="form-control" name="code" aria-label="Default" aria-describedby="code">
						  </div>

						<div class="input-group mb-3">
							<div class="input-group-prepend">
							  <span class="input-group-text"  id="buy_price">سعر الشراء </span>
							</div>
							<input type="text" class="form-control" name="buy_price" aria-label="Default" aria-describedby="buy_price">
						  </div>

						<div class="input-group mb-3">
							<div class="input-group-prepend">
							  <span class="input-group-text"  id="sell_price">سعر البيع </span>
							</div>
							<input type="text" class="form-control" name="sell_price" aria-label="Default" aria-describedby="sell_price">
						  </div>

						

						<div class="input-group mb-3">
							<div class="input-group-prepend">
							  <span class="input-group-text"  id="itemQuantity">وصف المنتج     </span>
							</div>
							<input type="text" class="form-control" name="description" aria-label="Default" aria-describedby="itemQuantity">
						  </div>
						</div>
						<div class="modal-footer">
							<button class="btn ripple btn-primary" type="submit">حفظ منتج جديد </button>
							<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">اغلاق</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- End Basic modal -->

		<div class="modal fade" id="invoiceDetailsModal" tabindex="-1" role="dialog" aria-labelledby="invoiceDetailsModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="invoiceDetailsModalLabel">تفاصيل الفاتوره</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<table id="invoiceDetailsTable" class="table">
							<thead>
								<tr>
									<th>رقم الفاتوره</th>
									<th>اسم المنتج </th>
									<th>سعر الشراء</th>
									<th>سعر البيع</th>
									<th>الكميات</th>
									<th>إجمالي البيع</th>
									<th>الربح</th>
								</tr>
							</thead>
							<tbody>
								<!-- Rows will be dynamically added here -->
							</tbody>
							<tfoot>
								<tr>
									<th colspan="2">الإجماليات:</th>
									<th id="totalBuyPrice"></th>
									<th></th>
									<th></th>
									<th id="totalSellPrice"></th>
									<th id="totalProfit"></th>
								</tr>
								
							</tfoot>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
					</div>
				</div>
			</div>
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
    var table = $('#products').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'excel', 'print'],
        ordering: false,
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("invoices.getinvoicesTable") }}',
            type: 'GET',
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'supplier_name', name: 'supplier_name', defaultContent: '' },
            { data: 'outlet_name', name: 'outlet_name', defaultContent: '' },
            { data: 'ordertype', name: 'ordertype' },
            { data: 'total_Buy_price', name: 'total_Buy_price' },
            { data: 'total_amount', name: 'total_amount' },
            { data: 'profit', name: 'profit' },
            { data: 'username', name: 'username' },
            { data: 'created_at', name: 'created_at' },
            {
                data: 'id',
                name: 'action',
                render: function(data, type, full, meta) {
                    var detailsButton = '<button class="btn btn-sm btn-info" onclick="showInvoiceDetails(' + data + ')"><i class="far fa-eye"></i>  تفاصيل</button>';
                    var editInvoiceRoute = "{{ route('invoices.showEditInvoice', ['id' => ':id']) }}";
                    editInvoiceRoute = editInvoiceRoute.replace(':id', data);

                    // Your existing action buttons
                    var existingButtons = '<a href="' + editInvoiceRoute + '" data-id="' + data + '" data-effect="effect-scale"  class="edit btn btn-success btn-sm"><i class="far fa-edit"></i> تعديل الفاتوره</a> <a href="#modaldemo9" data-id="' + data + '" data-effect="effect-scale" data-toggle="modal" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i> حذف</a>';

                    return detailsButton + ' ' + existingButtons;
                }
            }
        ],
        columnDefs: [
            {
                targets: 1, // Assuming 'supplier_name' is the 2nd column (0-based index)
                render: function(data, type, row, meta) {
                    // 'full' here contains the entire row data
                    return row.supplier ? row.supplier.name : '';
                }
            },
            {
                targets: 8, // Assuming 'created_at' is the 9th column (0-based index)
                render: function(data, type, row, meta) {
                    // Format the date using JavaScript Date object
                    var date = new Date(data);
                    return date.toLocaleDateString();
                }
            }
        ]
    });
});




function showInvoiceDetails(invoiceId) {
    // Check if DataTable is already initialized on the target table
    if ($.fn.DataTable.isDataTable('#invoiceDetailsTable')) {
        // DataTable is already initialized, destroy it before reinitializing
        $('#invoiceDetailsTable').DataTable().destroy();
    }

    // Use AJAX to fetch details based on the invoiceId
    $.ajax({
        url: '/invoices/details/' + invoiceId,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            // Handle the response and update modal content
            var detailsArray = response.details;

            // Update modal body content
            var tableBody = $('#invoiceDetailsTable tbody');
            tableBody.empty();

            for (var i = 0; i < detailsArray.length; i++) {
                var details = detailsArray[i];
                var row = '<tr>' +
                    '<td>' + details.invoice_id + '</td>' +
                    '<td>' + details.product_name + '</td>' +
                    '<td>' + details.buy_price + '</td>' +
                    '<td>' + details.sell_price + '</td>' +
                    '<td>' + details.quantity + '</td>' +
                    '<td>' + details.total + '</td>' +
                    '<td>' + details.profit_per_product + '</td>' +
                    '</tr>';
                tableBody.append(row);
            }

            // Calculate totals and update the footer
            var totalBuyPrice = detailsArray.reduce(function (sum, details) {
                return sum + parseFloat(details.buy_price * details.quantity);
            }, 0);

            var totalSellPrice = detailsArray.reduce(function (sum, details) {
                return sum + parseFloat(details.sell_price * details.quantity);
            }, 0);

            var totalProfit = detailsArray.reduce(function (sum, details) {
                return sum + parseFloat(details.profit_per_product);
            }, 0);

            var grandTotal = totalSellPrice - totalBuyPrice;

            // Update the totals in the footer
            $('#totalBuyPrice').text(totalBuyPrice.toFixed(2));
            $('#totalSellPrice').text(totalSellPrice.toFixed(2));
            $('#totalProfit').text(totalProfit.toFixed(2));
            $('#grandTotal').text(grandTotal.toFixed(2));

            // Initialize DataTable with the footer callback for totals
            var dataTable = $('#invoiceDetailsTable').DataTable({
                dom: 'Bfrtip',
                buttons: ['copy', 'excel', 'print'],
                footerCallback: function (row, data, start, end, display) {
                    var api = this.api();

                    // Calculate the total buy price, sell price, and profit
                    var totalBuyPrice = api.rows({ search: 'applied' }).data().reduce(function (a, b) {
                        var buyPrice = parseFloat(b[2]);
                        var quantity = parseFloat(b[4]);

                        if (!isNaN(buyPrice) && !isNaN(quantity)) {
                            return a + (buyPrice * quantity);
                        } else {
                            return a;
                        }
                    }, 0);

                    var totalSellPrice = api.rows({ search: 'applied' }).data().reduce(function (a, b) {
                        var sellPrice = parseFloat(b[3]);
                        var quantity = parseFloat(b[4]);

                        if (!isNaN(sellPrice) && !isNaN(quantity)) {
                            return a + (sellPrice * quantity);
                        } else {
                            return a;
                        }
                    }, 0);

                    var totalProfit = api.column(6, { search: 'applied' }).data().reduce(function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0);

                    // Update the totals in the footer
                    $('#totalBuyPrice').text(totalBuyPrice.toFixed(2));
                    $('#totalSellPrice').text(totalSellPrice.toFixed(2));
                    $('#totalProfit').text(totalProfit.toFixed(2));
                }
            });

            // Show the modal
            $('#invoiceDetailsModal').modal('show');
        },
        error: function (error) {
            console.error('Error fetching details:', error);
        }
    });
}


    </script>
@endpush
