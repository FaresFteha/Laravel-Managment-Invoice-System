@extends('layouts.backend.master')
@section('css')
@endsection

@section('title')
    pyfatora - الصفحة الرئيسية
@endsection


@section('contnet')
    <div class="row">
        <div class="col-12">
            <div class="card mb-3 btn-reveal-trigger">
                <div class="card-header position-relative min-vh-25 mb-8">
                    <div class="cover-image">
                        <div class="bg-holder rounded-3 rounded-bottom-0"
                            style="background-image:url({{ asset('asset/backend/src/img/generic/bg-2.jpg') }});">
                        </div>
                        <!--/.bg-holder-->
                    </div>
                    <div class="avatar avatar-5xl avatar-profile shadow-sm img-thumbnail rounded-circle">
                        <div class="h-100 w-100 rounded-circle overflow-hidden position-relative">
                            @if ( $profile->photo)
                            <img src="{{ asset('storage/Attachments/Client-Attachments/' . $profile->photo) }}"
                            width="200" alt="" data-dz-thumbnail="data-dz-thumbnail" />
                            @else
                            <img     src="{{ asset('asset/backend/src/img/team/avatar.png') }}"
                            width="200" alt="" data-dz-thumbnail="data-dz-thumbnail" />
                            @endif


                            <label class="mb-0 overlay-icon d-flex flex-center" for="profile-image"><span
                                    class="bg-holder overlay overlay-0"></span><span
                                    class="z-index-1 text-white dark__text-white text-center fs--1"><span
                                        class="fas fa-camera"></span><span class="d-block">تحديث</span></span></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-0">
        <div class="col-lg-8 pe-lg-2">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">اعدادت الملف الشخصي</h5>
                </div>
                <div class="card-body bg-light">
                    <form class="row g-3" action="{{ route('incoices.client.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input class="d-none" id="profile-image" name="photo" type="file" />
                        <div class="col-lg-6">
                            <label class="form-label" for="first-name">الاسم الاول</label>
                            <input class="form-control" id="first-name" name="first_name" type="text"
                                value="{{ $profile->first_name }}" />
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" for="last-name">الاسم الاخير</label>
                            <input class="form-control" id="last-name" name="last_name" type="text"
                                value="{{ $profile->last_name }}" />
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" for="email1">البريد الالكتروني</label>
                            <input class="form-control" id="email1" name="email" type="text"
                                value="{{ $profile->email }}" />
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" for="phone">رقم الهاتف</label>
                            <input class="form-control" id="phone" name="phone" type="text"
                                value="{{ $profile->phone }}" />
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label" for="email3">كلمة السر</label>
                            <input class="form-control" id="email3" type="text" />
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button class="btn btn-primary" type="submit">تحديث </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
