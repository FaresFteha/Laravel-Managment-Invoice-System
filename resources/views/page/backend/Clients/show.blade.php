@extends('layouts.backend.master')
@section('css')
@endsection

@section('title')
    payfatora- تفاصيل العميل
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
                    <h3>اضافة العملاء</h3>
                    <a class="btn btn-link btn-sm ps-0 mt-2" href="{{ route('home') }}">الذهاب الى لوحة التحكم<span
                            class="fas fa-chevron-left ms-1 fs--2"></span></a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('contnet')
    <div class="card mb-3">
        <div class="card-header">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0" data-anchor="data-anchor">تفاصيل العميل</h5>
                </div>
            </div>
        </div>
        <div class="card-body bg-light">
            <div class="tab-content">
                <div class="tab-pane preview-tab-pane active" role="tabpanel"
                    aria-labelledby="tab-dom-d4ebf6c5-74b4-4308-8c64-cda718c9b324"
                    id="dom-d4ebf6c5-74b4-4308-8c64-cda718c9b324">
                    <ul class="nav nav-pills" id="pill-myTab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="pill-home-tab" data-bs-toggle="tab"
                                href="#pill-tab-home" role="tab" aria-controls="pill-tab-home"
                                aria-selected="true">معلومات شخصية</a></li>
                        <li class="nav-item"><a class="nav-link" id="pill-profile-tab" data-bs-toggle="tab"
                                href="#pill-tab-profile" role="tab" aria-controls="pill-tab-profile"
                                aria-selected="false">الفواتير الخاصة</a></li>
                        {{-- <li class="nav-item"><a class="nav-link" id="pill-contact-tab" data-bs-toggle="tab"
                                href="#pill-tab-contact" role="tab" aria-controls="pill-tab-contact"
                                aria-selected="false">المدفوعات</a></li> --}}
                    </ul>
                    <div class="tab-content border p-3 mt-3" id="pill-myTabContent">
                        <div class="tab-pane fade show active" id="pill-tab-home" role="tabpanel"
                            aria-labelledby="home-tab">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="first_name">الاسم الكامل:</label>
                                    <span>{{ $Client->full_name }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="first_name">البريد الالكتروني:</label>
                                    <span>{{ $Client->email }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="first_name">التليفون:</label>
                                    <span>{{ $Client->phone }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="first_name">الدولة:</label>
                                    <span>{{ $Client->country->name }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="first_name">الولاية:</label>
                                    <span>{{ $Client->state->name }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="first_name">المدينة:</label>
                                    <span>{{ $Client->city->name }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="first_name">العنوان:</label>
                                    <span>{{ $Client->address }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="first_name">الرمز البريدي:</label>
                                    <span>{{ $Client->postal_code }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pill-tab-profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="table-responsive scrollbar">
                                <table class="table mb-0">
                                    <thead class="text-black bg-200">
                                        <tr>
                                            <th class="align-middle">#</th>
                                            <th class="align-middle">رقم الفاتورة/العميل</th>
                                            <th class="align-middle">تاريخ الفاتورة</th>
                                            <th class="align-middle">تاريخ الاستحقاق</th>
                                            <th class="align-middle">السعر</th>
                                            <th class="align-middle">السعر النهائي</th>
                                            <th class="align-middle">الحالة</th>
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
