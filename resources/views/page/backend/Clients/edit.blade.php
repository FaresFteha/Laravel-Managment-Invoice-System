@extends('layouts.backend.master')
@section('css')
    <link href="{{ asset('asset/backend/src/vendors/choices/choices.min.css') }}" rel="stylesheet" />
@endsection

@section('title')
    payfatora-تعديل بيانات العملاء
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
                    <h3>تعديل بيانات العملاء</h3>
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
                    <h5 class="mb-0" data-anchor="data-anchor">الاضافة</h5>
                </div>
            </div>
        </div>
        <div class="card-body bg-light">
            <div class="tab-content">
                <div class="tab-pane preview-tab-pane active" role="tabpanel"
                    aria-labelledby="tab-dom-d4ebf6c5-74b4-4308-8c64-cda718c9b324"
                    id="dom-d4ebf6c5-74b4-4308-8c64-cda718c9b324">
                    <form action="{{ route('clients.update', 'test') }}" method="POST" enctype="multipart/form-data"
                        class="row g-3">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6">
                            <input type="hidden" name="id" id="id" value="{{ $Client->id }}" />
                            <label class="form-label" for="first_name">الاسم الاول*</label>
                            <input class="form-control" id="first_name" name="first_name" type="text"
                                value="{{ old('first_name', $Client->first_name) }}"
                                class="@error('first_name') is-invalid @enderror" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="last_name">الاسم الاخير*</label>
                            <input class="form-control" id="last_name" name="last_name" type="text"
                                value="{{ old('last_name', $Client->last_name) }}"
                                class="@error('last_name')) is-invalid @enderror" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="email">البريد الالكتروني*</label>
                            <input class="form-control" id="email" name="email" type="email" autocomplete="off"
                                value="{{ old('email', $Client->email) }}" class="@error('email')) is-invalid @enderror" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="phone">رقم الجوال</label>
                            <input type="text" id="phone" name="phone" class="form-control"
                                placeholder="+48 999-999-999" autocomplete="off" value="{{ old('phone', $Client->phone) }}"
                                class="@error('phone') is-invalid @enderror" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="password">كلمة السر</label>
                            <input class="form-control" type="password" id="password" name="password" autocomplete="off"
                                aria-label="password" data-toggle="password"
                                value="{{ old('password', $Client->password) }}"
                                class="@error('password') is-invalid @enderror">
                            <div class="col-sm-9">
                                <input type="checkbox" class="form-check-input" onclick="Password()" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">عرض كلمة السر</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="password">تاكيد السر</label>
                            <input class="form-control" type="password" id="password2" name="password2"
                                autocomplete="off" aria-label="password" data-toggle="password"
                                value="{{ old('password2', $Client->password) }}">
                            <div class="col-sm-9">
                                <input type="checkbox" class="form-check-input" onclick="confirmPassword()"
                                    id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">عرض كلمة السر</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label" for="country_id">الدولة</label>
                                <select class="form-select js-choice" id="country_id" name="country_id"
                                    value="{{ old('country_id') }}">
                                    <option selected disabled>حدد الدولة...</option>
                                    @foreach ($countries as $items)
                                        <option value="{{ $items->id }}"
                                            {{ $items->id == $items->id ? 'selected' : '' }}>{{ $items->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="state_id">الولاية</label>
                                <select class="form-select" id="state_id" name="state_id"
                                    value="{{ old('state_id', $Client->state_id) }}">
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="city_id">المدينة</label>
                                <select class="form-select" id="city_id" name="city_id"
                                    value="{{ old('city_id', $Client->city_id) }}">

                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="address">العنوان</label>
                            <input class="form-control" id="address" name="address" type="text"
                                class="@error('address') is-invalid @enderror"
                                value="{{ old('address', $Client->address) }}" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="postal_code">الرمز البريدي</label>
                            <input class="form-control" id="postal_code" name="postal_code" type="text"
                                class="@error('postal_code') is-invalid @enderror"
                                value="{{ old('postal_code', $Client->postal_code) }}" />
                        </div>

                        {{-- About Photo --}}
                        <div class="col-md-6">
                            <label class="col-form-label" for="photos">الصورة الشحصية:<small style="color: red">أنواع الملفات المسموح بها: png, jpg, jpeg.</small></label>

                            <div class="col-sm-10">
                                <input class="form-control" id="photo" name="photo" type="file"
                                    accept="image/*" data-fouc />
                            </div>
                            <div class="mb-3">
                                <img class="rounded-circle shadow-sm" style="width: 100px" height="100px"
                                    src="{{ asset('storage/Attachments/Client-Attachments/' . $Client->photo) }}"
                                    alt="الصورة الشخصية" />
                            </div>
                        </div>

                        <div class="col-md-5 col-xl-12 col-xxl-5 ps-lg-4 ps-xl-2 ps-xxl-5 text-center text-md-start text-xl-center text-xxl-start">
                            <button class="btn btn-primary mt-3 px-5" type="submit">تحديث &amp; عميل</button>
                          </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('select[name="country_id"]').on('change', function() {
                var country_id = $(this).val();
                if (country_id) {
                    $.ajax({
                        url: "{{ route('states-list') }}",
                        type: "get",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'id': country_id
                        },
                        success: function(data) {
                            $('#state_id').html(data);
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });
        });

        $(document).ready(function() {
            $('select[name="state_id"]').on('change', function() {
                var state_id = $(this).val();
                if (state_id) {
                    $.ajax({
                        url: "{{ route('cities-list') }}",
                        type: "get",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'id': state_id
                        },
                        success: function(data) {
                            $('#city_id').html(data);
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
@endsection
