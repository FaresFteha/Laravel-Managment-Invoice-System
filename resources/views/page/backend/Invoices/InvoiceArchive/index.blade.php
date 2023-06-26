@extends('layouts.backend.master')
@section('css')
@endsection

@section('title')
    payfatora-ارشيف الفواتير
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
                    <h3>ارشيف الفواتير</h3>
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
        <div class="card-body py-0 border-top">
            <div class="tab-content">
                <div class="tab-pane preview-tab-pane active" role="tabpanel"
                    aria-labelledby="tab-dom-4493da1e-1e0b-4482-89ff-6cbf5297dee1"
                    id="dom-4493da1e-1e0b-4482-89ff-6cbf5297dee1">
                    <div class="card shadow-none">
                        <div class="card-body p-0 pb-3">
                            <div class="table-responsive scrollbar">
                                @include('page.backend.Invoices.InvoiceArchive.Filters.filtre')
                                <table class="table mb-0">
                                    <thead class="text-black bg-200">
                                        <tr>
                                            <th class="align-middle">#</th>
                                            <th class="align-middle">رقم الفاتورة/العميل</th>
                                            <th class="align-middle">تاريخ الفاتورة</th>
                                            <th class="align-middle">تاريخ الاستحقاق</th>
                                            <th class="align-middle">السعر</th>
                                            <th class="align-middle">السعر النهائي</th>
                                            {{-- <th class="align-middle">المعاملات</th> --}}
                                            <th class="align-middle">الحالة</th>
                                            <th class="align-middle white-space-nowrap pe-3">العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bulk-select-body">
                                        @forelse ($Incoices as $items)
                                            <tr>
                                                <th class="align-middle">{{ $loop->index + 1 }}</th>
                                                <th class="align-middle">
                                                    {{ $items->client->full_name }}<br>{{ $items->invoice_number }}
                                                    {{-- <a href="{{ route('invoices.show', $items->id) }}"> --}}
                                                    {{-- </a> --}}
                                                </th>
                                                <th class="align-middle">{{ $items->invoice_date }}</th>
                                                <th class="align-middle">{{ $items->due_date }}</th>
                                                <th class="align-middle">${{ $items->unit_price }}</th>
                                                <th class="align-middle">${{ $items->amount }}</th>
                                                {{-- <th class="align-middle">{{ $items->unit_price }}</th> --}}
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
                                                <th class="align-middle">
                                                    <div>
                                                        @can('الغاء ارشيف الفواتير')
                                                            <a class="btn p-0" type="button" data-bs-toggle="modal"
                                                                data-bs-target="#archif-modal{{ $items->id }}"
                                                                data-bs-placement="top" title="الغاء الارشيف"><i
                                                                    class="fas fa-sync-alt"
                                                                    style="color: rgba(101, 7, 224, 0.781)"></i> </a>
                                                        @endcan

                                                        @can('حذف الفواتير نهائياً')
                                                            <a class="btn p-0" type="button" data-bs-toggle="modal"
                                                                data-bs-target="#delete-modal{{ $items->id }}"
                                                                data-bs-placement="top" title="حذف"><i
                                                                    class="far fa-trash-alt"
                                                                    style="color: rgb(189, 26, 26)"></i></a>
                                                        @endcan

                                                    </div>

                                                </th>
                                            </tr>
                                            {{-- Delete Modal --}}
                                            @include('page.backend.Invoices.InvoiceArchive.modal-include.canselarchive')
                                            @include('page.backend.Invoices.InvoiceArchive.modal-include.delete')
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
