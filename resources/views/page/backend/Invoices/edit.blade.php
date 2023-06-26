@extends('layouts.backend.master')
@section('css')
    <link href="{{ asset('asset/backend/src/vendors/choices/choices.min.css') }}" rel="stylesheet" />
@endsection

@section('title')
    payfatora-تعديل الفاتورة
@endsection


@section('header-title')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card"
            style="background-image:url({{ asset('asset/backend/src/img/icons/spot-illustrations/corner-4.png') }});">
        </div>
        <!--/.bg-holder-->

        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>تعديل الفاتورة</h3>
                    <a class="btn btn-link btn-sm ps-0 mt-2" href="{{ route('home') }}">الذهاب الى لوحة التحكم<span
                            class="fas fa-chevron-left ms-1 fs--2"></span></a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('contnet')
    <div class="row g-3">

        <div class="col-xl-4 order-xl-1">
            <div class="card">
                <div class="card-header bg-light btn-reveal-trigger d-flex flex-between-center">
                    <h5 class="mb-0">ملخص الفاتورة</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless fs--1 mb-0">
                        <tr class="border-bottom">
                            <th class="ps-0 pt-0">المجموع الفرعي:</th>
                            <th class="pe-0 text-end pt-0"><input class="fw-bold" style="border: none" id="sub_ammount"
                                    name="sub_ammount" value="{{ $Invoice->unit_price }}" readonly disabled /></th>
                        </tr>
                        <tr class="border-bottom">
                            <th class="ps-0">الضرائب:</th>
                            <th class="pe-0 text-end"><input class="fw-bold" style="border: none" id="tax"
                                    name="tax" value="{{ $Invoice->value_vat }}" readonly disabled /></th>
                        </tr>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light">
                    <div class="fw-semi-bold">إجمالي</div>
                    <div class="fw-bold"><input class="fw-bold" style="border: none" id="amountAll" name="amountAll"
                            value="{{ $Invoice->amount }}" readonly disabled /></div>
                </div>
            </div>
        </div>

        <!-- General Invoice -->
        <div class="col-xl-8">
            <div class="card mb-3">
                {{-- @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-header bg-light">
                    <div class="row flex-between-center">
                        <div class="col-sm-auto">
                            <h5 class="mb-2 mb-sm-0">البيانات العامة للفاتورة</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('invoices.update', 'TEST') }}" method="POST" enctype="multipart/form-data"
                        class="row">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6">
                            <input type="hidden" name="id" id="id" value="{{ $Invoice->id }}">
                            <label class="form-label" for="client_id">العملاء</label>
                            <select class="form-select js-choice" id="client_id" name="client_id"
                                value="{{ old('client_id') }}">
                                @foreach ($Clients as $items)
                                    <option value="{{ $items->id }}" {{ $items->id == $items->id ? 'selected' : '' }}>
                                        {{ $items->full_name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="invoice_number">رقم الفاتورة:*</label>
                            <input class="form-control" id="invoice_number" name="invoice_number" type="text"
                                value="{{ old('invoice_number', $Invoice->invoice_number) }}" readonly />

                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="invoice_date">تاريخ الفاتورة:*</label>
                            <input class="form-control datetimepicker" id="datepicker" type="text" placeholder="d/m/y"
                                data-options='{"disableMobile":true}' name="invoice_date"
                                value="{{ old('invoice_date', $Invoice->invoice_date) }}" />

                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="due_date">تاريخ استحقاق الفاتورة:*</label>
                            <input class="form-control datetimepicker" id="datepicker" type="text" placeholder="d/m/y"
                                data-options='{"disableMobile":true}' name="due_date"
                                value="{{ old('due_date', $Invoice->due_date) }}" />

                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="status">الحالة</label>
                            <select class="form-select js-choice" id="status" name="status"
                                value="{{ old('status', $Invoice->status) }}">
                                <option value="تحت المعالجة">تحت المعالجة</option>
                                <option value="قبول">قبول</option>
                                <option value="غير المدفوعة">غير مدفوعة</option>
                                <option value="مدفوع">مدفوع</option>
                                <option value="مدفوع جزئياً">مدفوع جزئياً</option>
                                <option value="متأخر">متأخر</option>
                                <option value="مرفوض">مرفوض</option>
                                <option value="ألغيت">ألغيت</option>
                            </select>

                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="currency">العملات</label>
                            <select class="form-select js-choice" id="currency" name="currency"
                                value="{{ old('currency', $Invoice->currency) }}">
                                <option selected disabled>حدد العملة...</option>
                                @foreach ($currencies as $key => $currency)
                                    <option value="{{ $currency['name'] }}">{{ $currency['icon'] }}
                                        &nbsp;&nbsp;&nbsp; {{ $currency['name'] }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <div class="card-header bg-light">
                            <div class="row flex-between-center">
                                <div class="col-sm-auto">
                                    <h5 class="mb-2 mb-sm-0">بيانات شراء الفاتورة</h5>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-6">
                            <label class="form-label" for="product_id">المنتجات</label>
                            <select class="form-select js-choice" id="product_id" name="product_id"
                                value="{{ old('product_id', $Invoice->product->name) }}">
                                <option selected disabled>حدد المنتج...</option>
                                @foreach ($Product as $items)
                                    <option value="{{ $items->id }}" {{ $items->id == $items->id ? 'selected' : '' }}>
                                        {{ $items->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="quantity">الكمية</label>
                            <input class="form-control" id="quantity" name="quantity" type="text"
                                value="{{ $Invoice->quantity }}" onchange="priceUniteAmount()" />

                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="unit_price">السعر</label>
                            <input class="form-control" id="unit_price" name="unit_price" type="text"
                                value="{{ $Invoice->unit_price }}" />

                        </div>

                        <div class="col-md-6">
                            <label for="inputName" class="control-label">مبلغ العمولة</label>
                            <input type="text" class="form-control form-control-lg" id="amount_commission"
                                name="amount_commission" title="يرجي ادخال مبلغ العمولة "
                                value="{{ $Invoice->amount_commission }}"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="discount">الخصم</label>
                            <input class="form-control" id="discount" name="discount" type="number"
                                value="{{ $Invoice->discount }}" />

                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="tax_id">الضريبة</label>
                            <select class="form-select js-choice" id="tax_id" name="tax_id"
                                value="{{ old('tax_id', $Invoice->taxs->value) }}" onchange="myFunction()">
                                <option selected disabled>حدد الضربية...</option>
                                @foreach ($Tax as $items)
                                    <option value="{{ $items->id }}" {{ $items->id == $items->id ? 'selected' : '' }}>
                                        {{ $items->name }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="col-md-6">
                            <label for="inputName" class="control-label">قيمة ضريبة القيمة المضافة</label>
                            <input type="text" class="form-control" id="value_vat" name="value_vat"
                                value="{{ $Invoice->value_vat }}" readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="amount">المبلغ</label>
                            <input class="form-control" id="amount" name="amount" type="number"
                                value="{{ $Invoice->amount }}" readonly />
                        </div>
                        <div
                            class="col-md-5 col-xl-12 col-xxl-5 ps-lg-4 ps-xl-2 ps-xxl-5 text-center text-md-start text-xl-center text-xxl-start">
                            <button class="btn btn-success mt-3 px-5" type="submit">تحديث &amp; الفاتورة</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        //Output data in input field
        $(document).ready(function() {
            $('select[name="product_id"]').on('change', function() {
                var product_id = $(this).val();
                if (product_id) {
                    $.ajax({
                        url: "{{ route('products-list') }}",
                        type: "get",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'id': product_id
                        },
                        success: function(products) {
                            $('#unit_price').val(products.unit_price);
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
        //price Unit Amount
        function priceUniteAmount() {
            var Qy = parseFloat(document.getElementById("quantity").value); //الكمية
            var Unit_price = parseFloat(document.getElementById("unit_price").value); //سعر الوحدة
            //ضرب الكمية بسعر الوحدة
            var unitpriceall = Qy * Unit_price;
            $('#unit_price').val(unitpriceall);
            // document.getElementById("Unit_price").value = unitpriceall;
        }
    </script>
    <script>
        function myFunction() {
            //تعريف المتغيرات
            var Qy = parseFloat(document.getElementById("quantity").value); //الكمية
            var Unit_price = parseFloat(document.getElementById("unit_price").value); //سعر الوحدة
            var amount_commission = parseFloat(document.getElementById("amount_commission").value); //العمولة
            var Discount = parseFloat(document.getElementById("discount").value); //الخصم
            var tax_id = parseFloat(document.getElementById("tax_id").value); //الضربية
            var amount = parseFloat(document.getElementById("amount").value); //المبلغ النهائي


            //هان بيديني او بطلعلي عمولة المبلغ اني انقص مبلغ العمولة من الخصم
            var final_amount_commission = amount_commission - Discount;
            var final_amount_collection = Unit_price - final_amount_commission;

            if (typeof final_amount_commission === 'undefined' || !final_amount_commission) {
                alert('يرجي ادخال مبلغ العمولة ');
            } else {
                //هين بضرب الناتج الي طلع من تنقيص مبلع العمولة من الخصم على 100  الي هي قيمة ضريبة القيمة المضافة
                var intResults = final_amount_collection * tax_id / 100;
                // هان بقلوا اجمعلي الناتج الي طلع مع مبلغ العمولة الي هي قيمة ضريبة القيمة المضافة الي هي الاجمالي شامل الضريبة
                var intResults2 = parseFloat(intResults + final_amount_collection);

                //toFixed->طريقة تقريب السلسلة إلى عدد محدد من الكسور العشرية.
                sumq = parseFloat(intResults).toFixed(2);
                sumt = parseFloat(intResults2).toFixed(2);

                //Output result in input value
                $('#value_vat').val(sumq);
                $('#amount').val(sumt);

                $('#sub_ammount').val(Unit_price);
                $('#tax').val(sumq);
                $('#amountAll').val(sumt);

            }
        }
    </script>
@endsection
