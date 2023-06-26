@extends('layouts.backend.master')
@section('css')
    <link href="{{ asset('asset/backend/src/vendors/choices/choices.min.css') }}" rel="stylesheet" />
@endsection

@section('title')
    payfatora-الاعدادات
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
                    <h3>الاعدادات</h3>
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
            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('error') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
        <div class="card-body bg-light">
            <div class="tab-content">
                <div class="tab-pane preview-tab-pane active" role="tabpanel"
                    aria-labelledby="tab-dom-d4ebf6c5-74b4-4308-8c64-cda718c9b324"
                    id="dom-d4ebf6c5-74b4-4308-8c64-cda718c9b324">
                    <form action="{{ route('update-setting') }}" method="POST" enctype="multipart/form-data"
                        class="row g-3">
                        @csrf
                        <div class="col-md-6">
                            <label class="form-label" for="app_name">اسم التطبيق:*</label>
                            <input class="form-control" id="app_name" name="app_name" type="text"
                                value="{{ $setting['app_name'] }}" class="@error('app_name') is-invalid @enderror" />
                            @error('app_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="company_name">اسم الشركة*</label>
                            <input class="form-control" id="company_name" name="company_name" type="text"
                                value="{{ $setting['company_name'] }}"
                                class="@error('company_name') is-invalid @enderror" />
                            @error('company_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="email">البريد الالكتروني*</label>
                            <input class="form-control" id="email" name="email" type="email" autocomplete="off"
                                value="{{ $setting['email'] }}" class="@error('email') is-invalid @enderror" />
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="phone">رقم الجوال</label>
                            <input type="text" id="phone" name="phone" class="form-control" autocomplete="off"
                                value="{{ $setting['phone'] }}" class="@error('phone') is-invalid @enderror" />
                            @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="address">العنوان</label>
                            <input class="form-control" id="address" name="address" type="text"
                                class="@error('address') is-invalid @enderror" value="{{ $setting['address'] }}" />
                            @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="postal_code">الرمز البريدي</label>
                            <input class="form-control" id="postal_code" name="postal_code" type="text"
                                class="@error('postal_code') is-invalid @enderror" value="{{ $setting['postal_code'] }}" />
                            @error('postal_code')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="postal_code">مسح ذاكرة التخزين المؤقت:</label>
                            <a href="{{ route('clear-cache') }}">
                                <button class="btn btn-outline-primary rounded-pill me-1 mb-1" type="button">مسح ذاكرة
                                    التخزين المؤقت</button></a>

                        </div>
                        {{-- About Photo --}}
                        <div class="row">
                            <label class="col-form-label" for="photos">شعار التطبيق:<small style="color: red">أنواع
                                    الملفات المسموح بها: png, jpg, jpeg.</small></label>
                            <div class="col-sm-10">
                                <input class="form-control" id="photo" name="photo" type="file"
                                    accept="image/*" data-fouc />
                            </div>
                            <div class="mb-3">
                                <img style="width: 100px" height="100px"
                                    src="{{ URL::asset('storage/Attachments/Logo/' . $setting['photo']) }}"
                                    alt="شعار التطبيق" />
                            </div>
                            @error('photo')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div
                            class="col-md-5 col-xl-12 col-xxl-5 ps-lg-4 ps-xl-2 ps-xxl-5 text-center text-md-start text-xl-center text-xxl-start">
                            <button class="btn btn-primary mt-3 px-5" type="submit">تحديث البيانات</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
