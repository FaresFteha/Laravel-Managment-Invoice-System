@extends('layouts.backend.master')
@section('css')
@endsection

@section('title')
    payfatora-طباعة الفاتورة
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
                    <h3>طباعة الدفعة</h3>
                    <a class="btn btn-link btn-sm ps-0 mt-2" href="{{ route('home') }}">الذهاب الى لوحة التحكم<span
                            class="fas fa-chevron-right ms-1 fs--2"></span></a>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('contnet')
    <div class="card mb-3">
        <div class="card-body">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                    <button class="btn btn-falcon-default btn-sm me-1 mb-2 mb-sm-0" type="button"
                        onclick="printpdf()"><span class="fas fa-print me-1"> </span>طباعة</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-body" id="print">
            <div class="row align-items-center text-center mb-3">
                <div class="col-sm-6 text-sm-start"><img src="{{ asset('asset/backend/src/img/logos/logo-invoice-.png') }}"
                        alt="invoice" width="150" /></div>
                <div class="col text-sm-end mt-3 mt-sm-0">
                    <h2 class="mb-3">الفاتورة</h2>
                    <h5>PayInvoice-باي فاتورة</h5>
                    <p class="fs--1 mb-0">فلسطين-غزة<br />خانيونس-البلد</p>
                </div>
                <div class="col-12">
                    <hr />
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="text-500">فاتورة خاصة الى</h6>
                    <h5>{{ $Payment->invoice->client->full_name }}</h5>
                    <p class="fs--1">
                        {{ $Payment->invoice->client->country->name }}<br />{{ $Payment->invoice->client->state->name }}<br />{{ $Payment->invoice->client->city->name }}
                    </p>
                    <p class="fs--1"><a
                            href="{{ $Payment->invoice->client->email }}">{{ $Payment->invoice->client->email }}</a><br /><a
                            href="tel:{{ $Payment->invoice->client->phone }}">{{ $Payment->invoice->client->phone }}</a>
                    </p>
                </div>
                <div class="col-sm-auto ms-auto">
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless fs--1">
                            <tbody>
                                <tr>
                                    <th class="text-sm-end">رقم الفاتورة:</th>
                                    <td>{{ $Payment->invoice->invoice_number }}</td>
                                </tr>
                                <tr>
                                    <th class="text-sm-end">تاريخ الفاتورة:</th>
                                    <td>{{ $Payment->invoice->invoice_date }}</td>
                                </tr>
                                <tr>
                                    <th class="text-sm-end">تاريخ الاستحقاق:</th>
                                    <td>{{ $Payment->invoice->due_date }}</td>
                                </tr>
                                <tr class="alert-success fw-bold">
                                    <th class="text-sm-end">المبلغ المستحق:</th>
                                    <td>{{ $Payment->invoice->amount }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="table-responsive scrollbar mt-4 fs--1">
                <table class="table table-striped border-bottom">
                    <thead class="light">
                        <tr class="bg-primary text-white dark__bg-1000">
                            <th class="border-0">رقم الفاتورة</th>
                            <th class="border-0">المبلغ الاساسي</th>
                            <th class="border-0">المبلغ المدفوع</th>
                            <th class="border-0">المبلغ بعد الدفع</th>
                            <th class="border-0">نوع الدفع</th>
                            <th class="border-0">حالة الدفع</th>
                            <th class="border-0"> تاريخ الدفع</th>
                            <th class="border-0">المسؤول عن الدفع</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="align-middle">{{ $Payment->invoice->invoice_number }}</th>
                            <th class="align-middle">${{ $Payment->amount }}</th>
                            <th class="align-middle">${{ $Payment->payment_amount }}</span< /th>
                            <th class="align-middle">${{ $Payment->payment_total }}</th>
                            <th class="align-middle">{{ $Payment->payment_mode }}</th>
                            <th class="align-middle">{{ $Payment->status }}</th>
                            <th class="align-middle">{{ $Payment->payment_date }}</th>
                            <th class="align-middle">{{ $Payment->created_by }}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-light">
            <p class="fs--1 mb-0"><strong>ملاحظة:</strong>نحن نقدر حقًا عملك ، وإذا كان هناك أي شيء آخر يمكننا القيام به ،
                فيرجى إخبارنا!</p>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function printpdf() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>
@endsection
