@extends('layouts.backend.master')
@section('css')
@endsection

@section('title')
    pyfatora - الصفحة الرئيسية
@endsection


@section('contnet')
    <div class="row g-3 mb-3">
        <div class="col-xxl-6 col-lg-12">
            <div class="card h-100">
                <div class="bg-holder bg-card"
                    style="background-image:url({{ asset('asset/backend/src/img/icons/spot-illustrations/corner-3.png') }});">
                </div>
                <!--/.bg-holder-->

                <div class="card-header z-index-1">
                    <h5 class="text-primary">مرحبا بك
                        {{ Auth::guard('client')->user()->first_name . ' ' . Auth::guard('client')->user()->last_name }}
                    </h5>
                    <h6 class="text-600">دعنا نبدأ بالاحصائيات</h6>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-md-4">
            <div class="card overflow-hidden" style="min-width: 12rem">
                <div class="bg-holder bg-card"
                    style="background-image:url({{ asset('asset/backend/src/img/icons/spot-illustrations/corner-1.png') }});">
                </div>
                <!--/.bg-holder-->

                <div class="card-body position-relative">
                    <h6>مجموع المبالغ الاجمالية<span class="badge badge-soft-dark rounded-pill ms-2"></span></h6>
                    <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-dark">
                        {{ number_format(\App\Models\Payment::where('client_id', Auth::guard('client')->user()->id)->sum('amount'), 2, '.', ',') ?? '0' }}$
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card overflow-hidden" style="min-width: 12rem">
                <div class="bg-holder bg-card"
                    style="background-image:url({{ asset('asset/backend/src/img/icons/spot-illustrations/corner-2.png') }});">
                </div>
                <!--/.bg-holder-->

                <div class="card-body position-relative">
                    <h6>المبالغ المدفوعة<span class="badge badge-soft-dark rounded-pill ms-2"></span></h6>
                    <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-dark">
                        {{ number_format(\App\Models\Payment::where('client_id', Auth::guard('client')->user()->id)->sum('payment_amount'), 2, '.', ',') ?? '0' }}$
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card overflow-hidden" style="min-width: 12rem">
                <div class="bg-holder bg-card"
                    style="background-image:url({{ asset('asset/backend/src/img/icons/spot-illustrations/corner-3.png') }});">
                </div>
                <!--/.bg-holder-->

                <div class="card-body position-relative">
                    <h6>المبالغ المتبقية<span class="badge badge-soft-dark rounded-pill ms-2"></span></h6>
                    <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-dark">
                        {{ number_format(\App\Models\Invoice::where('client_id', Auth::guard('client')->user()->id)->sum('remaining_amount'), 2, '.', ',') ?? '0' }}$
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card overflow-hidden" style="min-width: 12rem">
                <div class="bg-holder bg-card"
                    style="background-image:url({{ asset('asset/backend/src/img/icons/spot-illustrations/corner-4.png') }});">
                </div>
                <!--/.bg-holder-->

                <div class="card-body position-relative">
                    <h6>عدد الفواتير<span class="badge badge-soft-dark rounded-pill ms-2"></span></h6>
                    <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-dark">
                        {{ \App\Models\Invoice::where('client_id', Auth::guard('client')->user()->id)->count() ?? '0' }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card overflow-hidden" style="min-width: 12rem">
                <div class="bg-holder bg-card"
                    style="background-image:url({{ asset('asset/backend/src/img/icons/spot-illustrations/corner-2.png') }});">
                </div>
                <!--/.bg-holder-->

                <div class="card-body position-relative">
                    <h6>إجمالي الفواتير المدفوعة<span class="badge badge-soft-dark rounded-pill ms-2"></span></h6>
                    <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-dark">
                        {{ \App\Models\Payment::where('client_id', Auth::guard('client')->user()->id)->where('status', 'مدفوع')->count() ?? '0' }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card overflow-hidden" style="min-width: 12rem">
                <div class="bg-holder bg-card"
                    style="background-image:url({{ asset('asset/backend/src/img/icons/spot-illustrations/corner-1.png') }});">
                </div>
                <!--/.bg-holder-->

                <div class="card-body position-relative">
                    <h6>إجمالي الفواتير غير المدفوعة<span class="badge badge-soft-dark rounded-pill ms-2"></span></h6>
                    <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-dark">
                        {{ \App\Models\Payment::where('client_id', Auth::guard('client')->user()->id)->where('status', 'غير مدفوعة')->count() ?? '0' }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
@endsection
