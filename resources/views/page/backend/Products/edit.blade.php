@extends('layouts.backend.master')
@section('css')
    <link href="{{ asset('asset/backend/src/vendors/choices/choices.min.css') }}" rel="stylesheet" />
@endsection

@section('title')
    payfatora-تحديث المنتجات
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
                    <h3>تحديث المنتجات</h3>
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
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0" data-anchor="data-anchor">التحديث</h5>
                </div>
            </div>
        </div>
        <div class="card-body bg-light">
            <div class="tab-content">
                <div class="tab-pane preview-tab-pane active" role="tabpanel"
                    aria-labelledby="tab-dom-d4ebf6c5-74b4-4308-8c64-cda718c9b324"
                    id="dom-d4ebf6c5-74b4-4308-8c64-cda718c9b324">
                    <form action="{{ route('products.update', 'test') }}" method="POST" enctype="multipart/form-data"
                        class="row g-3">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6">
                            <input type="hidden" id="id" name="id" value="{{ $products->id }}" />
                            <label class="form-label" for="name">اسم المنتج:*</label>
                            <input class="form-control" id="name" name="name" type="text"
                                value="{{ old('name', $products->name) }}" class="@error('name') is-invalid @enderror" />
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="code">رمز المنتج:*</label>
                            <input class="form-control" id="code" name="code" type="text"
                                value="{{ old('code', $products->code) }}" class="@error('code') is-invalid @enderror"
                                readonly />
                            @error('code')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="category_id">الفئة:</label>
                            <select class="form-select js-choice" id="category_id" name="category_id"
                                class="@error('category_id') is-invalid @enderror" value="{{ old('category_id') }}">
                                <option selected disabled>حدد الفئة...</option>
                                @foreach ($categories as $items)
                                    <option value="{{ $items->id }}" {{ $items->id == $items->id ? 'selected' : '' }}>
                                        {{ $items->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="unit_price">سعر الوحدة*</label>
                            <input class="form-control" id="unit_price" name="unit_price" type="number" autocomplete="off"
                                value="{{ old('unit_price', $products->unit_price) }}"
                                class="@error('unit_price') is-invalid @enderror" />
                            @error('unit_price')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="unit_count">عدد الوحدات*</label>
                            <input class="form-control" id="unit_count" name="unit_count" type="number" autocomplete="off"
                                value="{{ old('unit_count', $products->unit_count) }}" required />
                        </div>

                        <br>
                        <br>
                        <div class="mb-3">
                            <label class="form-label" for="description">الوصف:</label>
                            <textarea class="form-control" id="description" name="description" type="text"
                                class="@error('description') is-invalid @enderror">{{ old('description', $products->description) }}</textarea>
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- About Photo --}}
                        <div class="mb-3">
                            <label class="col-form-label" for="photos">صورة المنتج:<small style="color: red">أنواع
                                    الملفات المسموح بها: png, jpg, jpeg.</small></label>
                            <div class="col-sm-10">
                                <input class="form-control" id="photo" name="photo" type="file"
                                    accept="image/*" value="{{ $products->photo }}" data-fouc />
                            </div>
                            <div class="mb-3">
                                <img class="rounded-circle shadow-sm" style="width: 100px" height="100px"
                                    src="{{ asset('storage/Attachments/Product-Attachments/' . $products->photo) }}"
                                    alt="صورة المنتج" />
                            </div>
                            {{-- @error('photo')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror --}}
                            <br>
                            <div
                                class="col-md-5 col-xl-12 col-xxl-5 ps-lg-4 ps-xl-2 ps-xxl-5 text-center text-md-start text-xl-center text-xxl-start">
                                <button class="btn btn-primary mt-3 px-5" type="submit">تحديث &amp; منتج</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
