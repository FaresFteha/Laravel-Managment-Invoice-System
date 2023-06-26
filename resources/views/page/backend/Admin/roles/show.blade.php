@extends('layouts.backend.master')
@section('css')
    <link href="{{ asset('asset/backend/src/vendors/choices/choices.min.css') }}" rel="stylesheet" />
@endsection

@section('title')
    payfatora-عرض الادوار
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
                    <h3>عرض الادوار والصلاحيات الخاصة بالمسنخدم</h3>
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
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>الاسم:</strong>
                                {{ $role->name }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <a data-toggle="collapse" href="#role-permissions" role="button" aria-expanded="false"
                                        aria-controls="role-permissions">
                                        <strong>اظهار الصلاحيات</strong>
                                    </a>
                                    <div class="collapse" id="role-permissions">
                                        @if (!empty($rolePermissions))
                                            <ul>
                                                @foreach ($rolePermissions as $v)
                                                    <li>{{ $v->name }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p>No role permissions found.</p>
                                        @endif
                                    </div>
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
