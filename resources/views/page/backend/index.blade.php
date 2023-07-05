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
                    <h5 class="text-primary">مرحبا بك {{ Auth::user()->name }}</h5>
                    <h6 class="text-600">دعنا نبدأ بالاحصائيات</h6>
                </div>
                <div class="card-body z-index-1">
                    <div class="row g-2 h-100 align-items-end">
                        <div class="col-sm-6 col-md-5">
                            <div class="d-flex position-relative">
                                <div class="icon-item icon-item-sm border rounded-3 shadow-none me-2">
                                    <span class="fas fa-box text-primary"></span>
                                </div>
                                @can('المنتجات')
                                    <div class="flex-1"><a class="stretched-link" target="_blank"
                                            href="{{ route('products.index') }}">
                                            <h6 class="text-800 mb-0">المنتجات</h6>
                                        </a>
                                        <p class="mb-0 fs--2 text-500">تفحص المنتجات</p>
                                    </div>
                                @endcan

                            </div>
                        </div>
                        <div class="col-sm-6 col-md-5">
                            <div class="d-flex position-relative">
                                <div class="icon-item icon-item-sm border rounded-3 shadow-none me-2">
                                    <span class="fas fa-crown text-warning"></span>
                                </div>
                                @can('اضافة الفواتير')
                                    <div class="flex-1"><a class="stretched-link" target="_blank"
                                            href="{{ route('invoices.create') }}">
                                            <h6 class="text-800 mb-0">الفواتير</h6>
                                        </a>
                                        <p class="mb-0 fs--2 text-500">انشأ فاتورة</p>
                                    </div>
                                @endcan
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-5">
                            <div class="d-flex position-relative">
                                <div class="icon-item icon-item-sm border rounded-3 shadow-none me-2">
                                    <span class="fas fa-cog text-success"></span>
                                </div>
                                @can('المستخدمين')
                                    <div class="flex-1"><a class="stretched-link" target="_blank"
                                            href="{{ route('users.index') }}">
                                            <h6 class="text-800 mb-0">المستخدمين</h6>
                                        </a>
                                        <p class="mb-0 fs--2 text-500">تفحص المستخدمين</p>
                                    </div>
                                @endcan

                            </div>
                        </div>
                        <div class="col-sm-6 col-md-5">
                            <div class="d-flex position-relative">
                                <div class="icon-item icon-item-sm border rounded-3 shadow-none me-2">
                                    <span class="fas fa-user text-info"></span>
                                </div>
                                @can('العملاء')
                                    <div class="flex-1"><a class="stretched-link" target="_blank"
                                            href="{{ route('clients.index') }}">
                                            <h6 class="text-800 mb-0">العملاء</h6>
                                        </a>
                                        <p class="mb-0 fs--2 text-500">تفحص العملاء</p>
                                    </div>
                                @endcan

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-sm-6 col-md-4">
            <div class="card overflow-hidden" style="min-width: 12rem">
                <div class="bg-holder bg-card"
                    style="background-image:url({{ asset('asset/backend/src/img/icons/spot-illustrations/corner-1.png') }});">
                </div>
                <!--/.bg-holder-->

                <div class="card-body position-relative">
                    <h6>إجمالي العملاء<span class="badge badge-soft-warning rounded-pill ms-2"></span></h6>
                    <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-warning"
                        data-countup='{"endValue":{{ \App\Models\Client::count() ?? '0' }}}'>0</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="card overflow-hidden" style="min-width: 12rem">
                <div class="bg-holder bg-card"
                    style="background-image:url({{ asset('asset/backend/src/img/icons/spot-illustrations/corner-2.png') }});">
                </div>
                <!--/.bg-holder-->

                <div class="card-body position-relative">
                    <h6>إجمالي الفواتير<span class="badge badge-soft-info rounded-pill ms-2"></span></h6>
                    <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-info"
                        data-countup='{"endValue":{{ \App\Models\Invoice::count() ?? '0' }}}'>0</div>
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
                    <h6>إجمالي المنتجات<span class="badge badge-soft-success rounded-pill ms-2"></span></h6>
                    <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-success"
                        data-countup='{"endValue":{{ \App\Models\Product::count() ?? '0' }}}'>0</div>
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
                    <h6>إجمالي الفواتير المدفوعة</h6>
                    {{-- <span class="badge badge-soft-primary rounded-pill ms-2">
                        @if (\App\Models\Invoice::count() > 0)
                            {{ round((\App\Models\Payment::where(['status' => 'مدفوع'])->orWhere(['status' => 'مدفوع جزئياً'])->count() / \App\Models\Payment::count()) *100 )}}% 
                        @else
                            0%
                        @endif
                    </span --}}
                    <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-primary"
                        data-countup='{"endValue":{{ \App\Models\Payment::where(['status' => 'مدفوع'])->orWhere(['status' => 'مدفوع جزئياً'])->count() ?? '0' }}}'>
                        0</div>
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
                    <h6>إجمالي الفواتير غير المدفوعة
{{-- 
                        <span class="badge badge-soft-danger rounded-pill ms-2">
                            @if (\App\Models\Invoice::count() > 0)
                                {{ round((\App\Models\Payment::where('status', 'غير مدفوعة')->count() / \App\Models\Payment::count()) * 100) ?? '0' }}%
                            @else
                                0%
                            @endif
                        </span> --}}
                    </h6>
                    <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-danger"
                        data-countup='{"endValue":  {{ \App\Models\Payment::where(['status' => 'غير مدفوعة'])->count() ?? '0' }}}'>
                        0</div>
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
                    <h6>مجموع المبالغ المدفوعة<span class="badge badge-soft-secondary rounded-pill ms-2"></span></h6>
                    <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-secondary">
                        {{ number_format(\App\Models\Payment::where(['status' => 'مدفوع'])->orWhere(['status' => 'مدفوع جزئياً'])->sum('payment_amount'),2,'.',',') ?? '0' }}$
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
                    <h6>المبلغ الإجمالي<span class="badge badge-soft-dark rounded-pill ms-2"></span></h6>
                    <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-dark">
                        {{ number_format(\App\Models\Invoice::sum('amount'), 2, '.', ',') ?? '0' }}$</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-0">
        <div class="col-lg-6 pe-lg-2 mb-3">
            <div class="card h-lg-100 overflow-hidden">
                <div class="card-header bg-light">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="mb-0">شريط الرسم البياني</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    {!! $bar_chartjs->render() !!}
                </div>
            </div>
        </div>
        <div class="col-lg-6 ps-lg-2 mb-3">
            <div class="card h-lg-100">
                <div class="card-header">
                    <div class="row flex-between-center">
                        <div class="col-auto">
                            <h6 class="mb-0">مخطط دائري</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body h-100 pe-0" style="width: 75%" style="color: #8aa354">
                    {!! $chartjs->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
