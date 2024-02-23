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
    اضافه اذن مرتجع الي مخزن رئيسي 
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">اذونات جديده</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    اضافه اذن مرتجع الي مخزن رئيسي </span>
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
    <div class="row text-center" >

        <div class="col-lg-12 col-md-12">
            <div class="card card-success">
                <div class="card-header pb-1">
                    
                </div>
                <div class="card-body ">
                    
                    <form action="{{ route('returntomainwarhouse.store') }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}

                        <div class="row">
                            <div class="col">
                                <label for="whearhousID" class="control-label"> اسم المخزن</label>
                                    <select id="whearhousID" name="whearhousID" class="form-control">
                                       
                                        <option value="{{Auth::user()->whearhousname}}" selected >  {{Auth::user()->whearhousname}} </option>
                                    </select>
                            </div>

                            <div class="col">
                                <label> اسم الموظف المسؤل عن الإذن</label>
                                <select id="userID" name="userID" class="form-control">
                                    <option value="{{Auth::user()->name}}" selected >  {{Auth::user()->name}} </option>
                                </select>
                            </div>

                            <div class="col">
                                <label> الكميه المذكوره في الإذن</label>
                                <input class="form-control " name="quantity" placeholder="ادخل الكميه المطتوبه علي الاذن"
                                    type="number" required>
                            </div>

                        </div>

                        {{-- 2 --}}
                        <div class="row">
                            <div class="col">
                                <label for="ordertype" class="control-label">   نوع الإذن</label>
                                    <select id="ordertype" name="ordertype" class="form-control">
                                    <option value="مرتجع الي مخزن رئيسي" selected > مرتجع الي مخزن رئيسي</option>
                                    </select>
                            </div>

                           

                            <div class="col">
                                <label for="itemID" class="control-label">اسم الصنف</label>
                                <select id="itemID" name="itemID" class="form-control">
                                <option value="" selected disabled> اختر اسم الصنف</option>
                              <?php
                                    $products = DB::table('products')->select('id','itemName')->get();
                                    foreach ($products as $product)
                                    echo "<option value='" . $product->itemName ."' > $product->itemName </option>";   
                               ?>
                                 
                                </select>
                            </div>
                            <div class="col">
                                <label for="contractor" class="control-label">جهة الإرتجاع</label>
                                <select id="contractor" name="contractor" class="form-control js-example-basic-single">
                                    <option value="المورد" selected disabled> اختر اسم جهة الإرتجاع</option>
                                    <?php
                                    $MainWhearHouses = DB::table('main__whearhouses')->select('id','WhearHouseName')->get();
                                    foreach ($MainWhearHouses as $MainWhearHouse)
                                    echo "<option value='" . $MainWhearHouse->WhearHouseName ."' > $MainWhearHouse->WhearHouseName </option>";   
                               ?>
                                    
                                </select>
                            </div>

                            <div class="col">
                                <label for="orderID" class="control-label"> رقم الإذن</label>
                                <input type="text" class="form-control" id="orderID" name="orderID"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                        </div>


                        {{-- 3 --}}

                        <div class="row">

                            <div class="col">
                                <label for="date" class="control-label">تاريخ الإذن </label>
                                <input type="date" class="form-control fc-datepicker" id="date" name="date" title=""
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    required>
                            </div>

                            <div class="col">
                                <label for="orderDriver" class="control-label">اسم السائق</label>
                                <input type="text" class="form-control form-control-lg" id="orderDriver" name="orderDriver"
                                    title="يرجي ادخال اسم السائق " required>
                            </div>

                            <div class="col">
                                <label for="orderCar" class="control-label">   رقم السياره</label>
                               
                                    <input type="text" class="form-control form-control-lg" id="orderCar" name="orderCar"
                                    title="يرجي ادخال اسم السائق " required>
                                    <!--placeholder-->
                                
                            </div>

                        </div>

                        {{-- 4 --}}

                     

                        {{-- 5 --}}
                        <div class="row">
                            <div class="col">
                                <label for="comment">ملاحظات الإذن</label>
                                <textarea class="form-control" id="comment" name="comment" rows="2"></textarea>
                            </div>
                        </div><br>

                        <!--
                        <div class="col-sm-12 col-md-12 d-none">
                            <h5 class="card-title">صوره ضوئيه من الاذن</h5>
                            <input type="file" name="pic" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                            data-height="70" />
                            <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                        </div><br>
                    -->
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">حفظ البيانات</button>
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


@endsection