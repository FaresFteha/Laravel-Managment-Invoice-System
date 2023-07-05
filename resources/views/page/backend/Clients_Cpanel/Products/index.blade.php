@extends('layouts.backend.master')
@section('css')
@endsection

@section('title')
    pyfatora - المنتجات
@endsection


@section('contnet')
    <div class="card mb-3">
        <div class="card-body">
            <div class="row flex-between-center">
                <div class="col-sm-auto mb-2 mb-sm-0">
                    <h3 class="mb-0">المنتجات</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                @forelse ($products as $items)
                    <div class="mb-4 col-md-6 col-lg-4">
                        <div class="border rounded-1 h-100 d-flex flex-column justify-content-between pb-3">
                            <div class="overflow-hidden">
                                @if ($items->photo)
                                    <div class="position-relative rounded-top overflow-hidden"><a class="d-block">
                                            <img class="img-fluid rounded-top"
                                                src="{{ asset('storage/Attachments/Product-Attachments/' . $items->photo) }}"
                                                alt="" /></a>
                                    </div>
                                @else
                                    <div class="position-relative rounded-top overflow-hidden"><a class="d-block">
                                            <img class="img-fluid rounded-top"
                                                src="{{ asset('asset/backend/src/img/illustrations/bg-shape.png' . $items->photo) }}"
                                                alt="" /></a>
                                    </div>
                                @endif
                                <div class="p-3">
                                    <h5 class="fs-0"><a class="text-dark">{{ $items->name }}</a></h5>
                                    <p class="fs--1 mb-3"><a class="text-500"
                                            href="#!">{{ $items->category->name }}</a>
                                    </p>
                                    <h5 class="fs-md-2 text-warning mb-0 d-flex align-items-center mb-3">
                                        سعرالوحدة: {{ $items->unit_price }}$
                                    </h5>
                                    <p class="fs--1 mb-1">المخزن:
                                        @if ($items->stock_defective == 0)
                                            <strong class="text-danger">غير متاح في المخزن</strong>
                                        @else
                                            <strong class="text-success">متاح في المخزن</strong>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td class="alert-danger text-center" colspan="8">لا يوجد بيانات في هذا
                            الجدول
                        </td>
                    </tr>
                @endforelse

            </div>
        </div>
        <div class="card-footer bg-light d-flex justify-content-center">
            {!! $products->links() !!}
        </div>
    </div>
@endsection

@section('js')
@endsection
