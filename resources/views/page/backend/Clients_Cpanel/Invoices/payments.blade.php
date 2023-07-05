@extends('layouts.backend.master')
@section('css')
@endsection

@section('title')
    payfatora-مدفوعات الفواتير
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
                    <h3> مدفوعات الفواتير</h3>
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
            <div class="d-flex align-items-center justify-content-end my-3">
                <div id="bulk-select-replace-element">
                    @can('تصدير المدفوعات pdf')
                        <a href="{{ route('Incoices-Payment') }}">
                            <button class="btn btn-falcon-danger btn-sm" type="button" type="button">
                                <span class="fas fa-file-upload" data-fa-transform="shrink-3 down-2"></span><span
                                    class="ms-1">تصدير المدفوعات pdf</span></button>
                        </a>
                    @endcan

                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane preview-tab-pane active" role="tabpanel"
                    aria-labelledby="tab-dom-4493da1e-1e0b-4482-89ff-6cbf5297dee1"
                    id="dom-4493da1e-1e0b-4482-89ff-6cbf5297dee1">
                    <div class="card shadow-none">
                        <div class="card-body p-0 pb-3">
                            <div class="table-responsive scrollbar">
                                <table class="table mb-0">
                                    <thead class="text-black bg-200">
                                        <tr>
                                            <th class="align-middle">#</th>
                                            <th class="align-middle">رقم الفاتورة</th>
                                            <th class="align-middle">المبلغ الاساسي</th>
                                            <th class="align-middle">المبلغ المدفوع</th>
                                            <th class="align-middle">المبلغ بعد الدفع</th>
                                            <th class="align-middle">نوع الدفع</th>
                                            <th class="align-middle">حالة الدفع</th>
                                            <th class="align-middle"> تاريخ الدفع</th>
                                            <th class="align-middle">المسؤول عن الدفع</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bulk-select-body">
                                        @forelse ($payments as $items)
                                            <tr>
                                                <th class="align-middle">{{ $loop->index + 1 }}</th>
                                                <th class="align-middle">{{ $items->invoice->invoice_number }}</th>
                                                <th class="align-middle">${{ $items->amount }}</th>
                                                <th class="align-middle">${{ $items->payment_amount }}</span< /th>
                                                <th class="align-middle">${{ $items->payment_total }}</th>
                                                <th class="align-middle">{{ $items->payment_mode }}</th>
                                                <!-- Start Status value  -->
                                                @if ($items->status == 'غير مدفوعة')
                                                    <th class="align-middle"><span
                                                            class="badge rounded-pill badge-soft-danger">غير
                                                            مدفوعة</span></th>
                                                @elseif ($items->status == 'مدفوع')
                                                    <th class="align-middle"><span
                                                            class="badge rounded-pill badge-soft-success">مدفوع</span>
                                                    </th>
                                                @elseif ($items->status == 'مدفوع جزئياً')
                                                    <th class="align-middle"><span
                                                            class="badge rounded-pill badge-soft-primary">مدفوع
                                                            جزئياً</span></th>
                                                @else
                                                    <th class="align-middle"><span
                                                            class="badge rounded-pill badge-soft-danger">متاخر</span>
                                                    </th>
                                                @endif
                                                <!-- End Status value  -->
                                                <th class="align-middle">{{ $items->payment_date }}</th>
                                                <th class="align-middle">{{ $items->created_by }}</th>
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

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
