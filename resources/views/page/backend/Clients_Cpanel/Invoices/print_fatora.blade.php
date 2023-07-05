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
                    <h3>طباعة الفاتورة</h3>
                    <a class="btn btn-link btn-sm ps-0 mt-2" href="{{ route('home.client') }}">الذهاب الى لوحة التحكم<span
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
                <div class="col-md">
                    @php
                        $randomNumber = rand(1, 100);
                    @endphp
                    <h5 class="mb-2 mb-md-0">الطلب:{{ $randomNumber }}</h5>
                </div>
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
                    <h5>{{ $invoice->client->full_name }}</h5>
                    <p class="fs--1">
                        {{ $invoice->client->country->name }}<br />{{ $invoice->client->state->name }}<br />{{ $invoice->client->city->name }}
                    </p>
                    <p class="fs--1"><a href="{{ $invoice->client->email }}">{{ $invoice->client->email }}</a><br /><a
                            href="tel:{{ $invoice->client->phone }}">{{ $invoice->client->phone }}</a></p>
                </div>
                <div class="col-sm-auto ms-auto">
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless fs--1">
                            <tbody>
                                <tr>
                                    <th class="text-sm-end">رقم الفاتورة:</th>
                                    <td>{{ $invoice->invoice_number }}</td>
                                </tr>
                                <tr>
                                    <th class="text-sm-end">تاريخ الفاتورة:</th>
                                    <td>{{ $invoice->invoice_date }}</td>
                                </tr>
                                <tr>
                                    <th class="text-sm-end">تاريخ الاستحقاق:</th>
                                    <td>{{ $invoice->due_date }}</td>
                                </tr>
                                <tr class="alert-success fw-bold">
                                    <th class="text-sm-end">المبلغ المستحق:</th>
                                    <td>{{ $invoice->amount }}</td>
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
                            <th class="border-0">المنتج</th>
                            <th class="border-0 text-center">الكمية</th>
                            <th class="border-0 text-end">سعر الوحدة</th>
                            <th class="border-0 text-end">المبلغ المستحق</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="align-middle">
                                <h6 class="mb-0 text-nowrap">{{ $invoice->product->name }}</h6>
                                <p class="mb-0">{{ $invoice->product->code }}</p>
                            </td>
                            <td class="align-middle text-center">{{ $invoice->quantity }}</td>
                            <td class="align-middle text-end">${{ $invoice->product->unit_price }}</td>
                            <td class="align-middle text-end">${{ $invoice->amount }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row justify-content-end">
                <div class="col-auto">
                    <table class="table table-sm table-borderless fs--1 text-end">
                        <tr>
                            <th class="text-900">المبلغ الفرعي:</th>
                            <td class="fw-semi-bold">${{$invoice->amount_commission }} </td>
                        </tr>
                        <tr>
                            <th class="text-900">الضربية %:</th>
                            <td class="fw-semi-bold">{{ $invoice->taxs->value }}</td>
                        </tr>
                        <tr class="border-top">
                            <th class="text-900">المبلغ المستحق:</th>
                            <td class="fw-semi-bold">${{ $invoice->amount }}</td>
                        </tr>
                    </table>
                </div>
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
