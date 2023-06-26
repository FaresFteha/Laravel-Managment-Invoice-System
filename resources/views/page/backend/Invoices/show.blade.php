@extends('layouts.backend.master')
@section('css')
@endsection

@section('title')
    payfatora- تفاصيل الفاتورة
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
                    <h3>الفاتورة</h3>
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
                    <h5 class="mb-0" data-anchor="data-anchor">تفاصيل الفاتورة</h5>
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
                                aria-selected="true">معلومات
                                الفاتورة</a></li>
                        @can('مرفقات الفاتورة')
                            <li class="nav-item"><a class="nav-link" id="pill-profile-tab" data-bs-toggle="tab"
                                    href="#pill-tab-profile" role="tab" aria-controls="pill-tab-profile"
                                    aria-selected="false">مرفقات الفاتورة</a></li>
                        @endcan
                    </ul>
                    <div class="tab-content border p-3 mt-3" id="pill-myTabContent">
                        <div class="tab-pane fade show active" id="pill-tab-home" role="tabpanel"
                            aria-labelledby="home-tab">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="first_name">الاسم الكامل:</label>
                                    <span>{{ $invoice->client->full_name }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="first_name">رقم الفاتورة:</label>
                                    <span>{{ $invoice->invoice_number }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="first_name">تاريخ الفاتورة:</label>
                                    <span class="badge bg-success">{{ $invoice->invoice_date }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="first_name">تاريخ الاستحقاق:</label>
                                    <span class="badge bg-danger">{{ $invoice->due_date }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="first_name">الحالة:</label>
                                    <!-- Start Status value  -->
                                    @if ($invoice->value_status == 1)
                                        <span class="badge bg-warning">تحت
                                            المعالجة</span>
                                    @elseif ($invoice->value_status == 2)
                                        <span class="badge badge-danger">غير
                                            مدفوع</span>
                                    @elseif ($invoice->value_status == 3)
                                        <span class="badge badge-success">مدفوع</span>
                                    @elseif ($invoice->value_status == 4)
                                        <span class="badge badge-primary">مدفوع
                                            جزئياً</span>
                                    @elseif ($invoice->value_status == 5)
                                        <span class="badge badge-danger">متاخر</span>
                                    @elseif ($invoice->value_status == 6)
                                        <span class="badge bg-dark dark__bg-dark">مرفوض</span>
                                    @elseif ($invoice->value_status == 7)
                                        <span class="badge bg-secondary">ألغيت</span>
                                    @elseif ($invoice->value_status == 8)
                                        <span class="badge bg-info">قبول</span>
                                    @endif
                                    <!-- End Status value  -->

                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="first_name">العملة:</label>
                                    <span>{{ $invoice->currency }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="first_name">المنتج:</label>
                                    <span>{{ $invoice->product->name }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="first_name">الكمية:</label>
                                    <span>{{ $invoice->quantity }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="first_name">السعر:</label>
                                    <span>{{ $invoice->unit_price }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="first_name">مبلغ العمولة:</label>
                                    <span>{{ $invoice->amount_commission }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="first_name">مبلغ الخصم:</label>
                                    <span>{{ $invoice->discount }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="first_name">الضربية:</label>
                                    <span>{{ $invoice->taxs->value }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="first_name">قيمة ضريبة القيمة المضافة:</label>
                                    <span>{{ $invoice->value_vat }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="first_name">السعر النهائي:</label>
                                    <span><strong>{{ $invoice->amount }}</strong></span>
                                </div>
                            </div>
                        </div>
                        <!-- Insert File plus -->
                        <div class="tab-pane fade" id="pill-tab-profile" role="tabpanel" aria-labelledby="profile-tab">
                            @can('اضافة مرفقات')
                                <form action="{{ route('invoicesAttachments.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" for="customFileLg">ملفات اضافية خاصة بالفاتورة</label><br>
                                        <label class="col-form-label" for="photo">مرفق الفاتورة: <small
                                                style="color: red">أنواع الملفات المسموح بها: png, jpg, jpeg,
                                                pdf.</small></label>
                                        <input class="form-control form-control-lg" id="customFileLg" name="photo"
                                            type="file" required />

                                        <!-- Invoices numbers -->
                                        <input type="hidden" id="invoices_numbers" name="invoices_numbers"
                                            value="{{ $invoice->invoice_number }}" />
                                        <!-- Invoices ID -->
                                        <input type="hidden" id="invoice_id" name="invoice_id"
                                            value="{{ $invoice->id }}" />
                                    </div>
                                    <div
                                        class="col-md-5 col-xl-12 col-xxl-5 ps-lg-4 ps-xl-2 ps-xxl-5 text-center text-md-start text-xl-center text-xxl-start">
                                        <button class="btn btn-primary me-1 mb-1" type="submit">
                                            اضافة<span class="fas fa-folder-plus ms-1"
                                                data-fa-transform="shrink-3"></span></button>
                                    </div>
                                </form>
                            @endcan
                            <br>
                            <h5 style="color: #087edf">#معلومات المرفقات الخاصة بالفاتورة</h5>
                            <br>
                            <!--المرفقات-->
                            <div class="card card-statistics">
                                <div class="table-responsive mt-15">
                                    <table class="table center-aligned-table mb-0 table table-hover"
                                        style="text-align:center">
                                        <thead>
                                            <tr class="text-dark">
                                                <th scope="col">#</th>
                                                <th scope="col">رقم الفاتورة</th>
                                                <th scope="col">اسم الملف</th>
                                                <th scope="col">قام بالاضافة</th>
                                                <th scope="col">تاريخ الاضافة</th>
                                                <th scope="col">العمليات</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @forelse($idInvoiceAttachments as $items)
                                                <tr>
                                                    <td> {{ $loop->index + 1 }} </td>
                                                    <td> {{ $items->invoices_numbers }}</td>
                                                    <td> {{ $items->photo }}
                                                    </td>
                                                    <td> {{ $items->created_by }}</td>
                                                    <td> {{ $items->created_at->diffForHumans() }}</td>
                                                    <td colspan="2">
                                                        @can('تحميل مرفقات')
                                                            <a
                                                                href="{{ route('Insert-Attachments-donlowad', $items->photo) }}">
                                                                <button class="btn p-0" type="button"><span
                                                                        class="btn btn-outline-success btn-sm"><i
                                                                            class="far fa-arrow-alt-circle-down"></i></span></button>
                                                            </a>
                                                        @endcan

                                                        @can('حذف مرفقات')
                                                            <button class="btn p-0" type="button" data-bs-toggle="modal"
                                                                data-bs-target="#delete-modal{{ $items->id }}"
                                                                data-bs-placement="top" title="حذف"><span
                                                                    class="btn btn-outline-danger btn-sm"><i
                                                                        class="far fa-trash-alt"></i></span></button>
                                                        @endcan

                                                    </td>
                                                </tr>
                                                {{-- Delete Modal --}}
                                                @include('page.backend.Invoices.modal-include.deleteattachments')
                                            @empty
                                                <tr>
                                                    <td class="alert-danger text-center" colspan="6">لا يوجد بيانات في
                                                        هذا الجدول
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
    </div>
@endsection
@section('js')
    <script src="{{ asset('asset/backend/src/vendors/dropzone/dropzone.min.js') }}"></script>
@endsection
