@extends('layouts.backend.master')
@section('css')
@endsection

@section('title')
    payfatora-الادوار
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
                    <h3>الادوار الخاصة بالمسنخدم</h3>
                    <a class="btn btn-link btn-sm ps-0 mt-2" href="{{ route('home') }}">الذهاب الى لوحة التحكم<span
                            class="fas fa-chevron-right ms-1 fs--2"></span></a>

                </div>

            </div>
        </div>
    </div>
@endsection

@section('contnet')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0">جدول البيانات</h5>
                </div>
            </div>
        </div>
        <div class="card-body py-0 border-top">
            <div class="tab-content">
                <div class="tab-pane preview-tab-pane active" role="tabpanel"
                    aria-labelledby="tab-dom-4493da1e-1e0b-4482-89ff-6cbf5297dee1"
                    id="dom-4493da1e-1e0b-4482-89ff-6cbf5297dee1">
                    <div class="card shadow-none">
                        <div class="card-body p-0 pb-3">
                            <div class="d-flex align-items-center justify-content-end my-3">
                                <div id="bulk-select-replace-element">
                                    @can('اضافة الادوار')
                                        <a href="{{ route('roles.create') }}">
                                            <button class="btn btn-falcon-success btn-sm" type="button" type="button">
                                                <span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span><span
                                                    class="ms-1">اضافة</span></button>
                                        </a>
                                    @endcan
                                </div>
                            </div>
                            <div class="table-responsive scrollbar">
                                @include('page.backend.Admin.roles.Filters.filtre')
                                <table class="table mb-0">
                                    <thead class="text-black bg-200">
                                        <tr>
                                            <th class="align-middle">#</th>
                                            <th class="align-middle">الاسم</th>
                                            <th class="align-middle white-space-nowrap pe-3">العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bulk-select-body">
                                        @forelse ($roles as $key => $role)
                                            <tr>
                                                <th class="align-middle">{{ $loop->index + 1 }}</th>
                                                <th class="align-middle">{{ $role->name }}</th>
                                                <td class="text-end">
                                                    <div class="dropdown font-sans-serif position-static">
                                                        <button
                                                            class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal"
                                                            type="button" data-bs-toggle="dropdown" data-boundary="window"
                                                            aria-haspopup="true" aria-expanded="false"><span
                                                                class="fas fa-ellipsis-h fs--1"></span></button>

                                                        <div class="dropdown-menu dropdown-menu-end border py-0">
                                                            <div class="bg-white py-2">
                                                                @can('عرض الادوار')
                                                                    <a class="dropdown-item text-primary"
                                                                        href="{{ route('roles.show', $role->id) }}">عرض</a>
                                                                @endcan

                                                                @can('تعديل الادوار')
                                                                    <a class="dropdown-item text-primary"
                                                                        href="{{ route('roles.edit', $role->id) }}">تعديل</a>
                                                                @endcan

                                                                @can('حذف الادوار')
                                                                    <button class="dropdown-item text-primary" type="button"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#delete-modal{{ $role->id }}"
                                                                        data-bs-placement="top">حذف</button>
                                                                @endcan

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @include('page.backend.Admin.roles.modal-include.delete')
                                        @empty
                                            <tr>
                                                <td class="alert-danger text-center" colspan="3">لا يوجد بيانات في
                                                    هذاالجدول
                                                </td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                            {{ $roles->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
