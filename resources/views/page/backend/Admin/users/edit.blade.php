@extends('layouts.backend.master')
@section('css')
    <link href="{{ asset('asset/backend/src/vendors/choices/choices.min.css') }}" rel="stylesheet" />
@endsection

@section('title')
    payfatora-تعديل المستخدمين
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
                    <h3>تعديل المستخدمين</h3>
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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0" data-anchor="data-anchor">تعديل</h5>
                </div>
            </div>
        </div>
        <div class="card-body bg-light">
            <div class="tab-content">
                <div class="tab-pane preview-tab-pane active" role="tabpanel"
                    aria-labelledby="tab-dom-d4ebf6c5-74b4-4308-8c64-cda718c9b324"
                    id="dom-d4ebf6c5-74b4-4308-8c64-cda718c9b324">
                    <form action="{{ route('users.update', $user->id) }}" method="POST" class="row g-3">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>الاسم:</strong>
                                    <input type="text" name="name" placeholder="الاسم" class="form-control"
                                        value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>الايميل:</strong>
                                    <input type="email" name="email" placeholder="الايميل" class="form-control"
                                        value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>كلمة السر:</strong>
                                    <input type="password" id="password" name="password" placeholder="كلمة السر"
                                        class="form-control">
                                </div>
                                <div class="col-sm-9">
                                    <input type="checkbox" class="form-check-input" onclick="Password()" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">عرض كلمة السر</label>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong> تاكيد كلمة السر:</strong>
                                    <input type="password" id="password2" name="confirm-password"
                                        placeholder="تاكيد كلمة السر"  class="form-control">
                                </div>
                                <div class="col-sm-9">
                                    <input type="checkbox" class="form-check-input" onclick="confirmPassword()"
                                        id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">عرض كلمة السر</label>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>الدور:</strong>
                                    <select class="form-select" id="status" name="status" value="{{ old('status') }}">
                                        <option value="مفعل">مفعل</option>
                                        <option value="غير مفعل">غير مفعل</option>
                                    </select>

                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>الدور:</strong>
                                    <select name="roles_name[]" class="form-control" multiple>
                                        @foreach ($roles as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ in_array($key, $userRole) ? 'selected' : '' }}>{{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div
                                class="col-md-5 col-xl-12 col-xxl-5 ps-lg-4 ps-xl-2 ps-xxl-5 text-center text-md-start text-xl-center text-xxl-start">
                                <button class="btn btn-primary mt-3 px-5" type="submit">تعديل الدور&amp; مع
                                    الصلاحية</button>
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
