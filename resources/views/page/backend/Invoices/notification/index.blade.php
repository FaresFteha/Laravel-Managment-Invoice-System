@extends('layouts.backend.master')
@section('css')
    <link href="{{ asset('asset/backend/src/vendors/choices/choices.min.css') }}" rel="stylesheet" />
@endsection

@section('title')
    payfatora-اشعارات الفاتورة
@endsection
@section('contnet')
    <div class="card overflow-hidden mb-3">
        <div class="card-header bg-light">
            <div class="row flex-between-center">
                <div class="col-sm-auto">
                    <h5 class="mb-1 mb-md-0">اشعاراتك</h5>
                </div>
                <div class="col-sm-auto fs--1"><a class="font-sans-serif ms-2 ms-sm-3" href="{{ route('readAllNotify') }}">اشر
                        عليها انها قرأت</a></div>
            </div>
        </div>

        <div class="card-body fs--1 p-0">
            @forelse(auth()->user()->Notifications as $notification)
                <a class="border-bottom-0 notification rounded-0 border-x-0 border-300">
                    <div class="notification-avatar">
                        <div class="avatar avatar-xl me-3">
                            <img class="rounded-circle"
                                src="{{ asset('asset/backend/src/img/generic/image-file-2.png') }}" />

                        </div>
                    </div>
                    <div class="notification-body">
                        <p class="mb-1"><strong>
                                {{ $notification->data['user'] }}</strong>{{ $notification->data['title'] }}</p>
                        <span class="notification-time"><span class="me-2" role="img"
                                aria-label="Emoji">📢</span>{{ $notification->created_at->diffForHumans() }}</span>

                    </div>
                </a>
            @empty
                <tr>
                    <td class="alert-danger text-center" colspan="8">لا يوجد اشعارات
                    </td>
                </tr>
            @endforelse
        </div>
    
    </div>
@endsection
@section('js')
@endsection
