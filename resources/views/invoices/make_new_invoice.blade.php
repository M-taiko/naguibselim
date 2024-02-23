@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
    اضافه فاتورة جديدة
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">فواتير </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    اضافه فاتورة جديدة </span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- row -->
    <div class="row text-center">

        <div class="col-lg-12 col-md-12">
            <div class="card card-danger">
                <div class="card-header pb-1">

                </div>
                <div class="card-body ">

                    <form action="{{ route('invoices.store') }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}

                        <div class="row">


                            <div class="col d-none">
                                <label> اسم الموظف المسؤل عن الإذن</label>
                                <select id="userID" name="userID" class="form-control">
                                    <option value="{{ Auth::user()->name }}" selected> {{ Auth::user()->name }} </option>
                                </select>
                            </div>



                        </div>
                        <div class="row">


                            <div class="col ">
                                <input type="hidden" name="username" value="{{ auth()->user()->name }}">

                                <label> اسم المورد</label>
                                <select id="suppliers" name="supplier_name" class="form-control" required>
                                    <option value="" selected disabled> اختر اسم المورد</option>
                                    <?php
                                    $suppliers = DB::table('suppliers')
                                        ->select('id', 'name', 'code')
                                        ->get();
                                    foreach ($suppliers as $supplier) {
                                        echo "<option value='" . $supplier->id . "' > " . $supplier->code . ' - ' . $supplier->name . '</option>';
                                    }
                                    ?>

                                </select>
                                
                            </div>

                            <div class="col ">
                                <label> اسم المنفذ</label>
                                <select id="outlet" name="outlet_name" class="form-control" required>
                                    <option value="" selected disabled> اختر اسم المنفذ</option>
                                    <?php
                                    $outlets = DB::table('outlets')
                                        ->select('id', 'name')
                                        ->get();
                                    foreach ($outlets as $outlet) {
                                        echo "<option value='" . $outlet->name . "' > " . $outlet->name . '</option>';
                                    }
                                    ?>

                                </select>
                            </div>



                        </div>
                        <hr>
                        {{-- 2 --}}
                        <div class="row">
                            <div class="col d-none">
                                <label for="ordertype" class="control-label"> نوع الفاتورة</label>
                                <select id="ordertype" name="ordertype" class="form-control ">
                                    <option value="BuyAndSell" selected>شراء من مورد وبيع الي منفذ</option>
                                </select>
                            </div>



                            <div class="col ">
                                <label for="name" class="control-label">اسم الصنف</label>
                                <select id="name" name="product_id" class="form-control">
                                    <option value="" selected disabled> اختر اسم الصنف</option>
                                    <?php
                                    $products = DB::table('products')
                                        ->select('id', 'name', 'code', 'sell_price', 'buy_price')
                                        ->get();
                                    foreach ($products as $product) {
                                        echo "<option value='" . $product->id . "' > " . $product->code . ' - ' . $product->name . '</option>';
                                    }
                                    ?>

                                </select>



                            </div>
                            <button type="button" class="btn btn-primary" onclick="addProduct()">اضف منتج</button>
                        </div>

                        <hr>

                        <div class="row">
                            <table id="productTable" class="table">
                                <thead>
                                    <tr>
                                        <th>اسم الصنف</th>
                                        <th>سعر الشراء</th>
                                        <th>سعر البيع</th>
                                        <th>الكمية</th>
                                        <th>الإجمالي</th>
                                        <th>الربح</th>
                                        <th>حذف </th>

                                    </tr>
                                </thead>
                                <tbody id="productTableBody"></tbody>

                                <tfoot id="totalRowContainer">
                                    <!-- The total row will be inserted here -->
                                </tfoot>
                            </table>
                        </div>
                </div><br>








<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
   
    var products = [];
    var totalRow;

    function isProductAdded(productId) {
        return products.some(function (product) {
            return product.productId === productId;
        });
    }

    function addTotalRow() {
        if (!totalRow) {
            totalRow = document.createElement('tr');
            totalRow.id = 'totalRow';
            totalRow.innerHTML = '<td><strong>الإجماليات</strong></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td><strong>إجمالي سعر البيع: <span class="total-sell-price">0.00</span>' +
                '<input type="hidden" name="total_amount" class="total-amount-input" /></strong></td>' +
                '<td><strong>اجمالي سعر الشراء : <span class="total-buy-price">0.00</span><input type="hidden" class="d-none total-buy-price-input"  name="total_Buy_price"/></strong></td>' +
                '<td><strong>إجمالي الأرباح: <span class="total-profit">0.00</span>' +
                '<input type="hidden" name="profit" class="total-profit-input" /></strong></td>';

            var totalRowContainer = document.getElementById('totalRowContainer');
            totalRowContainer.appendChild(totalRow);
        }
    }

    function addProduct() {
        var productId = document.getElementById('name').value;
        var productName = document.getElementById('name').options[document.getElementById('name').selectedIndex].text;

        if (productId && !isProductAdded(productId)) {
            // Fetch prices from the server using AJAX
            $.ajax({
                url: '/get-product-prices', // Replace with the actual route
                method: 'GET',
                data: {
                    productId: productId
                },
                success: function (prices) {
                    if (prices) {
                        var product = {
                            productId: productId,
                            productName: productName,
                            buyPrice: prices.buy_price,
                            sellPrice: prices.sell_price,
                            quantity: 1, // Set default quantity to 1
                            profit: 0 // Initialize profit to 0
                        };

                        products.push(product);

                        var newRow = generateProductRow(product);
                        document.getElementById('productTableBody').insertAdjacentHTML('beforeend', newRow);

                        // Add a row for the total
                        addTotalRow();

                        // Update profit for the added product
                        updateProfitForProduct(productId);
                    }
                },
                error: function () {
                    console.error('Error fetching product prices');
                }
            });
        }
    }

    function generateProductRow(product) {
        return '<tr id="productRow_' + product.productId + '">' +
            '<td>' + product.productName +
            '<input type="hidden" name="product_id[]" value="' + product.productId + '">' +
            '<input type="hidden" name="product_name[]" value="' + product.productName + '"></td>' +
            '<td><input oninput="calculateTotal(this)" type="text" name="buy_prices[]" class="form-control"  value="' + product.buyPrice + '" contenteditable></td>' +
            '<td><input oninput="calculateTotal(this)" type="text" name="sell_prices[]" class="form-control" value="' + product.sellPrice + '" contenteditable></td>' +
            '<td><input type="text" name="quantities[]" class="form-control" oninput="calculateTotal(this)" value="' + product.quantity + '" required></td>' +
            '<td><input type="text" name="totals[]" class="form-control" readonly></td>' +
            '<td><span class="d-none profit-per-product">0.00</span><input type="text" class="form-control profit-per-product-input" name="profit_per_product[]" readonly/></td>' +
            '<td class="d-none"><span class="product-profit">0.00</span></td>' +
            '<td><button type="button" class="btn btn-danger btn-sm" onclick="removeProduct(\'' + product.productId + '\')"><i class="fa fa-trash"></i></button></td>' +
            '</tr>';
    }

    function calculateTotal(input) {
        var row = input.closest('tr');
        var productId = row.id.split('_')[1];
        var product = products.find(function (product) {
            return product.productId === productId;
        });

        var sell_price = parseFloat(row.querySelector('input[name="sell_prices[]"]').value);
        var quantity = parseFloat(input.value);
        var totalInput = row.querySelector('input[name="totals[]"]');
        var total = sell_price * quantity;

        totalInput.value = total.toFixed(2);

        // Update the quantity in the product object
        product.quantity = quantity;

        // Recalculate the total row after updating a product
        calculateTotalRow();

        // Update profit for the product
        updateProfitForProduct(productId);
    }

    function calculateTotalRow() {
        var totalBuyPrice = 0;
        var totalSellPrice = 0;
        var totalProfit = 0;

        // Iterate through all product rows and sum up buy, sell prices, and profit
        products.forEach(function (product) {
            var buyPrice = parseFloat(document.getElementById('productRow_' + product.productId).querySelector('input[name="buy_prices[]"]').value) || 0;
            var sellPrice = parseFloat(document.getElementById('productRow_' + product.productId).querySelector('input[name="sell_prices[]"]').value) || 0;
            var quantity = parseFloat(document.getElementById('productRow_' + product.productId).querySelector('input[name="quantities[]"]').value) || 0;

            var totalBuyPricePerProduct = buyPrice * quantity;
            var totalSellPricePerProduct = sellPrice * quantity;
            var profitPerProduct = totalSellPricePerProduct - totalBuyPricePerProduct;

            totalBuyPrice += totalBuyPricePerProduct;
            totalSellPrice += totalSellPricePerProduct;
            totalProfit += profitPerProduct;

            // Update profit for the product in the row
            var profitSpan = document.getElementById('productRow_' + product.productId).querySelector('.profit-per-product');
            profitSpan.textContent = profitPerProduct.toFixed(2);

            // Update profit in the product object
            product.profit = profitPerProduct;
        });

        // Update the total row values
        totalRow.querySelector('.total-buy-price').textContent = totalBuyPrice.toFixed(2);
        totalRow.querySelector('.total-sell-price').textContent = totalSellPrice.toFixed(2);
        totalRow.querySelector('.total-amount-input').value = totalSellPrice.toFixed(2);
        totalRow.querySelector('.total-buy-price-input').value = totalBuyPrice.toFixed(2);
        totalRow.querySelector('.total-profit').textContent = totalProfit.toFixed(2);
        totalRow.querySelector('.total-profit-input').value = totalProfit.toFixed(2);
    }

    function updateProfitForProduct(productId) {
        var product = products.find(function (product) {
            return product.productId === productId;
        });

        var buyPrice = parseFloat(document.getElementById('productRow_' + productId).querySelector('input[name="buy_prices[]"]').value) || 0;
        var sellPrice = parseFloat(document.getElementById('productRow_' + productId).querySelector('input[name="sell_prices[]"]').value) || 0;
        var quantity = parseFloat(product.quantity) || 0;
        var profit_per_product = document.getElementById('productRow_' + productId).querySelector('.profit-per-product');
        var profit_per_product_input = document.getElementById('productRow_' + productId).querySelector('.profit-per-product-input');
        var productProfitSpan = document.getElementById('productRow_' + productId).querySelector('.product-profit');

        var totalBuyPricePerProduct = buyPrice * quantity;
        var totalSellPricePerProduct = sellPrice * quantity;
        var profit = totalSellPricePerProduct - totalBuyPricePerProduct;

        profit_per_product.textContent = profit.toFixed(2);
        profit_per_product_input.value = profit;

        // Update the profit for the product in the row
        productProfitSpan.textContent = profit.toFixed(2);

        // Recalculate the total row after updating a product
        calculateTotalRow();
    }

    function removeProduct(productId) {
        var index = products.findIndex(function (product) {
            return product.productId === productId;
        });

        if (index !== -1) {
            products.splice(index, 1);

            var row = document.getElementById('productRow_' + productId);
            if (row) {
                row.remove();

                // Recalculate the total row after removing a product
                calculateTotalRow();
            }
        }
    }

    function storeProductsInDatabase() {
        // Iterate through products and send data to the server
        products.forEach(function (product) {
            $.ajax({
                url: '/store-products', // Replace with the actual route
                method: 'POST',
                data: {
                    productId: product.productId,
                    productName: product.productName,
                    buyPrice: product.buyPrice,
                    sellPrice: product.sellPrice,
                    quantity: product.quantity,
                    profit_per_product: product.profit  // Corrected the property name
                },
                success: function (response) {
                    console.log('Product stored in the database:', response);
                },
                error: function (error) {
                    console.error('Error storing product in the database:', error);
                }
            });
        });
    }
</script>





         
                
                







                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">حفظ الفاتوره</button>
                </div>


                </form>
            </div>
        </div>
    </div>
    </div>




    </div>

    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>

    <script>
        $(document).ready(function() {
            $('select[name="Section"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('section') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="product"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="product"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>


    <script>
        function myFunction() {
            var Amount_Commission = parseFloat(document.getElementById("Amount_Commission").value);
            var Discount = parseFloat(document.getElementById("Discount").value);
            var Rate_VAT = parseFloat(document.getElementById("Rate_VAT").value);
            var Value_VAT = parseFloat(document.getElementById("Value_VAT").value);
            var Amount_Commission2 = Amount_Commission - Discount;
            if (typeof Amount_Commission === 'undefined' || !Amount_Commission) {
                alert('يرجي ادخال مبلغ العمولة ');
            } else {
                var intResults = Amount_Commission2 * Rate_VAT / 100;
                var intResults2 = parseFloat(intResults + Amount_Commission2);
                sumq = parseFloat(intResults).toFixed(2);
                sumt = parseFloat(intResults2).toFixed(2);
                document.getElementById("Value_VAT").value = sumq;
                document.getElementById("Total").value = sumt;
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#name').select2();
        });
     



        $(document).ready(function() {
            $('#suppliers').select2();
        });


        $(document).ready(function() {
            $('#outlet').select2();
        });
    </script>

@endsection
