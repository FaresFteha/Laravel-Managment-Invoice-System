@extends('layouts.backend.master')
@section('css')
@endsection

@section('title')
    payfatora-المستخدمين
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
                    <h3>المستخدمين</h3>
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
                                    @can('اضافة المستخدمين')
                                        <a href="{{ route('users.create') }}">
                                            <button class="btn btn-falcon-success btn-sm" type="button" type="button">
                                                <span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span><span
                                                    class="ms-1">اضافة</span></button>
                                        </a>
                                    @endcan

                                </div>
                            </div>
                            <div class="table-responsive scrollbar">
                                @include('page.backend.Admin.users.Filters.filtre')
                                <table class="table mb-0">
                                    <thead class="text-black bg-200">
                                        <tr>
                                            <th class="align-middle">#</th>
                                            <th class="align-middle">الاسم</th>
                                            <th class="align-middle">ايميل</th>
                                            <th class="align-middle">الحالة</th>
                                            <th class="align-middle">الدور الخاص به</th>
                                            <th class="align-middle white-space-nowrap pe-3">العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bulk-select-body">
                                        @forelse ($data as $key => $user)
                                            <tr>
                                                <th class="align-middle">{{ $loop->index + 1 }}</th>
                                                <th class="align-middle">{{ $user->name }}</th>
                                                <th class="align-middle">{{ $user->email }}</th>
                                                <th class="align-middle">
                                                    @if ($user->status === 'مفعل')
                                                        <span class="badge rounded-pill badge-soft-success">مفعل</span>
                                                    @else
                                                        <span class="badge rounded-pill badge-soft-danger">غير مفعل</span>
                                                    @endif
                                                </th>
                                                <th>
                                                    @if (!empty($user->getRoleNames()))
                                                        @foreach ($user->getRoleNames() as $v)
                                                            <span
                                                                class="badge rounded-pill badge-soft-primary">{{ $v }}</span>
                                                        @endforeach
                                                    @endif
                                                </th>
                                                <td class="text-end">
                                                    <div class="dropdown font-sans-serif position-static">
                                                        <button
                                                            class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal"
                                                            type="button" data-bs-toggle="dropdown" data-boundary="window"
                                                            aria-haspopup="true" aria-expanded="false"><span
                                                                class="fas fa-ellipsis-h fs--1"></span></button>

                                                        <div class="dropdown-menu dropdown-menu-end border py-0">
                                                            <div class="bg-white py-2">
                                                                @can('عرض المستخدمين')
                                                                    <button class="dropdown-item text-primary"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#show-modal{{ $user->id }}"
                                                                    data-bs-placement="top">عرض</button>
                                                                @endcan

                                                                @can('تعديل المستخدمين')
                                                                    <a class="dropdown-item text-primary"
                                                                        href="{{ route('users.edit', $user->id) }}">تعديل</a>
                                                                @endcan

                                                                @can('حذف المستخدمين')
                                                                    <button class="dropdown-item text-primary" type="button"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#delete-modal{{ $user->id }}"
                                                                        data-bs-placement="top">حذف</button>
                                                                @endcan

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @include('page.backend.Admin.users.modal-include.delete')
                                            @include('page.backend.Admin.users.modal-include.show')
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
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
