@extends('layouts.backend.master')
@section('css')
@endsection

@section('title')
    payfatora-المنتجات
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
                    <h3>واجهة المنتجات</h3>
                    <a class="btn btn-link btn-sm ps-0 mt-2" href="{{ route('home') }}">الذهاب الى لوحة التحكم<span
                            class="fas fa-chevron-right ms-1 fs--2"></span></a>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('contnet')
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
                                    @can('اضافة المنتجات')
                                        <a href="{{ route('products.create') }}">
                                            <button class="btn btn-falcon-success btn-sm" type="button" type="button">
                                                <span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span><span
                                                    class="ms-1">اضافة</span></button>
                                        </a>
                                    @endcan
                                </div>
                            </div>
                            <div class="table-responsive scrollbar">
                                @include('page.backend.Products.Filters.filtre')
                                <table class="table mb-0">
                                    <thead class="text-black bg-200">
                                        <tr>
                                            <th class="align-middle">#</th>
                                            <th class="align-middle">الصورة</th>
                                            <th class="align-middle">الاسم / رمز المنتج:</th>
                                            <th class="align-middle white-space-nowrap pe-3">العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bulk-select-body">
                                        @forelse ($products as $items)
                                            <tr>
                                                <th class="align-middle">{{ $loop->index + 1 }}</th>
                                                <th class="align-middle">
                                                    @if ($items->photo)
                                                        <img class="rounded-circle shadow-sm"
                                                            src="{{ asset('storage/Attachments/Product-Attachments/' . $items->photo) }}"
                                                            width="60" height="60" alt="{{ $items->name }}">
                                                    @else
                                                        <img class="rounded-circle shadow-sm"
                                                            src="{{ asset('asset/backend/src/img/illustrations/bg-shape.png' . $items->photo) }}"
                                                            width="60" height="60" alt="{{ $items->name }}">
                                                    @endif
                                                </th>
                                                <th class="align-middle">{{ $items->name }}<br>
                                                    <a
                                                    @can('عرض تفاصيل المنتجات')
                                                    href="{{ route('products.show', $items->id) }}"
                                                    @endcan><strong>{{ $items->code }}</strong></a>

                                                </th>
                                                <td class="align-middle">
                                                    <div>
                                                        @can('تعديل المنتجات')
                                                            <a href="{{ route('products.edit', $items->id) }}">
                                                                <button class="btn p-0" type="button" data-bs-placement="top"
                                                                    title="تعديل" type="button"><span
                                                                        class="text-500 fas fa-edit"></span></button>
                                                            </a>
                                                        @endcan

                                                        @can('حذف المنتجات')
                                                            <button class="btn p-0" type="button" data-bs-toggle="modal"
                                                                data-bs-target="#delete-modal{{ $items->id }}"
                                                                data-bs-placement="top" title="حذف"><span
                                                                    class="text-500 fas fa-trash-alt"></span></button>
                                                        @endcan
                                                    </div>
                                                </td>
                                            </tr>
                                            {{-- Delete Modal --}}
                                            @include('page.backend.products.modal-include.delete')
                                        @empty
                                            <tr>
                                                <td class="alert-danger text-center" colspan="4">لا يوجد بيانات في هذا
                                                    الجدول
                                                </td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
