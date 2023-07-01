@extends('layouts.backend.master')
@section('css')
@endsection

@section('title')
    payfatora-الفاتورة
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
                    <h3>واجهة الفاتورة</h3>
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
                                    @can('اضافة الفواتير')
                                        <a href="{{ route('invoices.create') }}">
                                            <button class="btn btn-falcon-success btn-sm" type="button" type="button">
                                                <span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span><span
                                                    class="ms-1">اضافة</span></button>
                                        </a>
                                    @endcan
                                    @can('تصدير الفواتير pdf')
                                        <a href="{{ route('Incoices-Print-All') }}">
                                            <button class="btn btn-falcon-danger btn-sm" type="button" type="button">
                                                <span class="fas fa-file-upload"
                                                    data-fa-transform="shrink-3 down-2"></span><span class="ms-1">تصدير
                                                    الفواتير pdf</span></button>
                                        </a>
                                    @endcan
                                </div>
                            </div>
                            <div class="table-responsive scrollbar">
                                @include('page.backend.Invoices.Filters.filtre')
                                <table class="table mb-0">
                                    <thead class="text-black bg-200">
                                        <tr>
                                            <th class="align-middle">#</th>
                                            <th class="align-middle">رقم الفاتورة/العميل</th>
                                            <th class="align-middle">تاريخ الفاتورة</th>
                                            <th class="align-middle">تاريخ الاستحقاق</th>
                                            <th class="align-middle">السعر</th>
                                            <th class="align-middle">السعر النهائي</th>
                                            <th class="align-middle">المتبقي</th>
                                            <th class="align-middle">الحالة</th>
                                            <th class="align-middle white-space-nowrap pe-3">العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bulk-select-body">
                                        @forelse ($Incoices as $items)
                                            <tr>
                                                <th class="align-middle">{{ $loop->index + 1 }}</th>
                                                <th class="align-middle">{{ $items->client->full_name }}<br>
                                                    @can('عرض تفاصيل الفواتير')
                                                        <a href="{{ route('invoices.show', $items->id) }}">
                                                            {{ $items->invoice_number }}</a>
                                                    @endcan
                                                </th>
                                                <th class="align-middle">{{ $items->invoice_date }}</th>
                                                <th class="align-middle">{{ $items->due_date }}</th>
                                                <th class="align-middle">${{ $items->unit_price }}</th>
                                                <th class="align-middle">${{ $items->amount }}</th>
                                                <th class="align-middle">${{ $items->remaining_amount }}</th>
                                               
                                                <!-- Start Status value  -->
                                                @if ($items->value_status == 1)
                                                    <th class="align-middle"><span class="badge bg-warning">تحت
                                                            المعالجة</span></th>
                                                @elseif ($items->value_status == 2)
                                                    <th class="align-middle"><span class="badge badge-danger">غير
                                                            مدفوع</span></th>
                                                @elseif ($items->value_status == 3)
                                                    <th class="align-middle"><span class="badge badge-success">مدفوع</span>
                                                    </th>
                                                @elseif ($items->value_status == 4)
                                                    <th class="align-middle"><span class="badge badge-primary">مدفوع
                                                            جزئياً</span></th>
                                                @elseif ($items->value_status == 5)
                                                    <th class="align-middle"><span class="badge badge-danger">متاخر</span>
                                                    </th>
                                                @elseif ($items->value_status == 6)
                                                    <th class="align-middle"><span
                                                            class="badge bg-dark dark__bg-dark">مرفوض</span></th>
                                                @elseif ($items->value_status == 7)
                                                    <th class="align-middle"><span class="badge bg-secondary">ألغيت</span>
                                                    </th>
                                                @elseif ($items->value_status == 8)
                                                    <th class="align-middle"><span class="badge bg-info">قبول</span>
                                                    </th>
                                                @endif
                                                <!-- End Status value  -->
                                                <th>
                                                    <button class="btn btn-falcon-default dropdown-toggle"
                                                        id="dropdownMenuButton" type="button" data-bs-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">عمليات الفاتورة</button>
                                                    <div class="dropdown-menu">
                                                        @can('تعديل الفواتير')
                                                            <a class="dropdown-item"
                                                                href="{{ route('invoices.edit', $items->id) }}"><i
                                                                    class="fa fa-edit" style="color: rgb(29, 32, 202)"></i>
                                                                تعديل الفاتورة</a>
                                                        @endcan

                                                        @can('تغير حالة الفواتير')
                                                            <a class="dropdown-item"
                                                                href="{{ route('invoicesstatus.edit', $items->id) }}"><i
                                                                    class="fas fa-sync" style="color: rgb(0, 125, 141)"></i>
                                                                تغير الحالة</a>
                                                        @endcan

                                                        {{-- <a class="dropdown-item" type="button" data-bs-toggle="modal"
                                                            data-bs-target="#change-status-modal{{ $items->id }}"
                                                            data-bs-placement="top"><i class="fas fa-money-bill-alt"
                                                                style="color: rgb(21, 199, 89)"></i> تغير الحالة
                                                            للفاتورة</a> --}}

                                                        @can('الحالات الخاصة للفواتير')
                                                            <a class="dropdown-item"
                                                                href="{{ route('invoicesstatus.show', $items->id) }}"><i
                                                                    class="fas fa-exchange-alt"
                                                                    style="color: rgb(0, 177, 147)"></i>
                                                                الحالات الخاصة</a>
                                                        @endcan

                                                        <?php
                                                        $payments = App\Models\Payment::pluck('payment_amount');
                                                        ?>
                                                        @can('دفع الفواتير')
                                                            @if ($items->amount == $payments)
                                                                {{ 'Fares' }}
                                                            @else
                                                                <a class="dropdown-item" type="button"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#payment-modal{{ $items->id }}"
                                                                    data-bs-placement="top"><i class="fas fa-money-bill-alt"
                                                                        style="color: rgb(21, 199, 89)"></i> دفع الفاتورة</a>
                                                            @endif
                                                        @endcan

                                                        @can('تحميل وطباعة الفواتير')
                                                            <a class="dropdown-item" target="_blank"
                                                                href="{{ route('invoicePrint', $items->id) }}"><i
                                                                    class="fas fa-print" style="color: rgb(224, 84, 42)"></i>
                                                                تحميل & طباعة الفاتورة</a>
                                                        @endcan

                                                        @can('ارشفة الفواتير')
                                                            <a class="dropdown-item" type="button" data-bs-toggle="modal"
                                                                data-bs-target="#archif-modal{{ $items->id }}"
                                                                data-bs-placement="top">
                                                                <i class="fas fa-archive"
                                                                    style="color: rgba(101, 7, 224, 0.781)"></i> ارشفة
                                                                الفاتورة</a>
                                                        @endcan

                                                        <div class="dropdown-divider"></div>
                                                        @can('حذف الفواتير')
                                                            <a class="dropdown-item" type="button" data-bs-toggle="modal"
                                                                data-bs-target="#delete-modal{{ $items->id }}"
                                                                data-bs-placement="top"><i class="far fa-trash-alt"
                                                                    style="color: rgb(189, 26, 26)"></i> حذف الفاتورة</a>
                                                        @endcan

                                                    </div>
                                                </th>
                                            </tr>
                                            {{-- Delete Modal --}}
                                            @include('page.backend.Invoices.modal-include.archive')
                                            {{-- @include('page.backend.Invoices.modal-include.statuschange') --}}
                                            @include('page.backend.Invoices.modal-include.delete')
                                            @include('page.backend.Invoices.modal-include.payment')
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
