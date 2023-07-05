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
                    <h3>واجهة فواتيرك</h3>
                    <a class="btn btn-link btn-sm ps-0 mt-2" href="{{ route('home.client') }}">الذهاب الى لوحة التحكم<span
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
                            <div class="table-responsive scrollbar">
                                {{-- @include('page.backend.Invoices.Filters.filtre') --}}
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
                                                    <a href="{{ route('incoices.client.show', $items->id) }}">
                                                        {{ $items->invoice_number }}</a>
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
                                                <th class="align-middle text-center">

                                                    <a href="{{ route('incoices.client.payment', $items->id) }}">
                                                        <button class="btn p-0" type="button" title="الدفوعات"><i class="fas fa-money-bill-alt"></i></button>
                                                    </a>

                                                    <a href="{{ route('incoices.client.printFatora', $items->id) }}">
                                                        <button class="btn p-0" type="button" title="طباعة"><span
                                                                class="fas fa-print"></span></button>
                                                    </a>
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
