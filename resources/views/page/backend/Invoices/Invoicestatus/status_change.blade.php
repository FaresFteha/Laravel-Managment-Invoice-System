@extends('layouts.backend.master')
@section('css')
    <link href="{{ asset('asset/backend/src/vendors/choices/choices.min.css') }}" rel="stylesheet" />
@endsection

@section('title')
    payfatora-تعديل حالة الفاتورة
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
                    <h3>تعديل حالة الفاتورة</h3>
                    <a class="btn btn-link btn-sm ps-0 mt-2" href="{{ route('home') }}">الذهاب الى لوحة التحكم<span
                            class="fas fa-chevron-left ms-1 fs--2"></span></a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('contnet')
    <div class="row g-3">
        <!-- General Invoice -->
        <div class="col-xl-8">
            <div class="card mb-3">
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
                <div class="card-header bg-light">
                    <div class="row flex-between-center">
                        <div class="col-sm-auto">
                            <h5 class="mb-2 mb-sm-0">اجراء التعديل على قبول, رفض, الغاء الفاتورة </h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('invoicesstatus.store') }}" method="POST" class="row">
                        @csrf
                        <input type="hidden" id="id" name="id" value="{{ $Invoice->id }}">
                        <div class="col-md-6">
                            <label class="form-label" for="status">الحالة</label>
                            <select class="form-select js-choice" id="status" name="status"
                                class="@error('status') is-invalid @enderror" value="{{ old('status') }}">
                                <option value="{{ $Invoice->status }}" selected disabled>{{ $Invoice->status }}</option>
                                <option value="تحت المعالجة">تحت المعالجة</option>
                                <option value="قبول">قبول</option>
                                <option value="مرفوض">مرفوض</option>
                                <option value="ألغيت">ألغيت</option>
                            </select>
                            @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div
                            class="col-md-5 col-xl-12 col-xxl-5 ps-lg-4 ps-xl-2 ps-xxl-5 text-center text-md-start text-xl-center text-xxl-start">
                            <button class="btn btn-success mt-3 px-5" type="submit">تحديث &amp; الحالة</button>
                        </div>
                    </form>
                </div>
            </div>
        @endsection

        @section('js')
        @endsection
