@extends('layouts.backend.master')
@section('css')
@endsection

@section('title')
    payfatora-حالات الفواتير
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
                    <h3>حالات الفواتير</h3>
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
                                <table class="table mb-0">
                                    <thead class="text-black bg-200">
                                        <tr>
                                            <th class="align-middle">#</th>
                                            <th class="align-middle">رقم الفاتورة</th>
                                            <th class="align-middle">الحالة</th>
                                            <th class="align-middle">تاريخ الحالة بالايام</th>
                                            <th class="align-middle">تاريخ الحالة</th>
                                            <th class="align-middle">مغير الحالة</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bulk-select-body">
                                        @forelse ($invoiceStatus as $items)
                                            <tr>
                                                <th class="align-middle">{{ $loop->index + 1 }}</th>
                                                <th class="align-middle">{{ $items->invoices->invoice_number }}<br>
                                                </th>
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
                                                <th class="align-middle">{{ $items->created_at->diffForHumans() }}
                                                </th>
                                                <th class="align-middle">{{ $items->created_at->format('Y-m-d') }}
                                                </th>
                                                <th class="align-middle">{{ $items->created_by }}</th>
                                            </tr>
                                        @empty
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
