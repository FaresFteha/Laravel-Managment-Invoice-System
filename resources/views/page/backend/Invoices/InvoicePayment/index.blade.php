@extends('layouts.backend.master')
@section('css')
@endsection

@section('title')
    payfatora-الفواتير
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
                    <h3>واجهة مدفوعات الفاتورة</h3>
                    <a class="btn btn-link btn-sm ps-0 mt-2" href="{{ route('home') }}">الذهاب الى لوحة التحكم<span
                            class="fas fa-chevron-right ms-1 fs--2"></span></a>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('contnet')
    <div class="card">
        <div class="card-header">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0">جدول البيانات</h5>
                </div>
            </div>
        </div>
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('error') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card-body py-0 border-top">
            <div class="tab-content">
                <div class="tab-pane preview-tab-pane active" role="tabpanel"
                    aria-labelledby="tab-dom-4493da1e-1e0b-4482-89ff-6cbf5297dee1"
                    id="dom-4493da1e-1e0b-4482-89ff-6cbf5297dee1">
                    <div class="card shadow-none">
                        <div class="card-body p-0 pb-3">
                            <div class="d-flex align-items-center justify-content-end my-3">
                                <div id="bulk-select-replace-element">
                                    @can('جميع المدفوعات')
                                        <a href="{{ route('payment.create') }}">
                                            <button class="btn btn-falcon-primary btn-sm" type="button" type="button">
                                                <span data-fa-transform="shrink-3 down-2"></span><span class="ms-1">جميع
                                                    المدفوعات </span></button>
                                        </a>
                                    @endcan

                                </div>
                            </div>
                            <div class="table-responsive scrollbar">
                                @include('page.backend.Invoices.InvoicePayment.Filters.filtre')
                                <table class="table mb-0">
                                    <thead class="text-black bg-200">
                                        <tr>
                                            <th class="align-middle">#</th>
                                            <th class="align-middle">رقم الفاتورة</th>
                                            <th class="align-middle">تاريخ الفاتورة</th>
                                            <th class="align-middle">تاريخ الاستحقاق</th>
                                            <th class="align-middle">السعر</th>
                                            <th class="align-middle">السعر النهائي</th>
                                            <th class="align-middle white-space-nowrap pe-3">العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bulk-select-body">
                                        @forelse ($Incoices as $items)
                                            <tr>
                                                <th class="align-middle">{{ $loop->index + 1 }}</th>
                                                <th class="align-middle">{{ $items->invoice_number }}</th>
                                                <th class="align-middle">{{ $items->invoice_date }}</th>
                                                <th class="align-middle">{{ $items->due_date }}</span< /th>
                                                <th class="align-middle">${{ $items->unit_price }}</th>
                                                <th class="align-middle">${{ $items->amount }}</th>
                                                <th>
                                                    @can('المدفوعات الخاصة')
                                                        <a href="{{ route('payment.show', $items->id) }}">
                                                            <button class="btn btn-sm btn-primary d-lg-block mt-lg-2"
                                                                type="button"> الدفوعات</button>
                                                        </a>
                                                    @endcan

                                                </th>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="alert-danger text-center" colspan="8">لا يوجد بيانات في هذا
                                                    الجدول
                                                </td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                            {{ $Incoices->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
