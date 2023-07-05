@extends('layouts.backend.master')
@section('css')
@endsection

@section('title')
    payfatora- تفاصيل المنتج
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
                    <h3>تفاصيل المنتج</h3>
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
                    <h5 class="mb-0" data-anchor="data-anchor">تفاصيل المنتج</h5>
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
                                aria-selected="true">المنتج بالكامل</a></li>

                    </ul>
                    <div class="tab-content border p-3 mt-3" id="pill-myTabContent">
                        <div class="tab-pane fade show active" id="pill-tab-home" role="tabpanel"
                            aria-labelledby="home-tab">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="first_name">اسم المنتج</label>
                                    <span>{{ $products->name }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="first_name">رمز المنتج:</label>
                                    <span>{{ $products->code }}</span>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="first_name">الفئة:</label>
                                    <span>{{ $products->category->name }}</span>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="first_name">سعر الوحدة:</label>
                                    <span>{{ $products->unit_price }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="first_name">عدد الوحدات:</label>
                                    <span>{{ $products->unit_count }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="first_name">الوصف:</label>
                                    <span >{{ $products->description}}</span>
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
@endsection
