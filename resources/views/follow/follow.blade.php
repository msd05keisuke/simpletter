@extends('layouts.app')

@section('content')
<div class="container">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <center class="m-t-30"> <a href="/profile/{{ $user->id }}"><img src="/uploads/avatars/{{ $user->avatar }}" class="img-circle" width="150"></a>
                        <h4 class="card-title m-t-10">{{ $user->name }}</h4>
                        <h6 class="card-subtitle">{{ $user->email }}</h6>
                        @auth
                        @if($user->id != Auth::user()->id)
                        <follow-component :user="{{ json_encode($user) }}"></follow-component>
                        @endif
                        @endauth

                        <div class="row text-center justify-content-md-center">
                            <div class="col-4"><a href="{{ route('showfollower', $user) }}" class="link"><i class="fa fa-user"></i>
                                    <font class="font-medium">{{ $user->followers->count() }}フォロワー</font>
                                </a></div>
                            <div class="col-4"><a href="{{ route('showfollow', $user) }}" class=""><i class="fa fa-user"></i>
                                    <font class="font-medium">{{ $user->followings->count() }}フォロー</font>
                                </a></div>
                        </div>
                    </center>
                </div>
            </div>

            @foreach($user->followings()->latest()->paginate(5) as $user)
            <div class="card-body">
                <div class="col-md-12">
                    <div class="media g-mb-30 media-comment">
                        <a href="/profile/{{ $user->id }}"><img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15" src="/uploads/avatars/{{ $user->avatar }}" alt="Image Description"></a>
                        <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                            <div class="g-mb-15">
                                <ul class="list-inline d-sm-flex my-0">
                                    <h5 class="h5 g-color-gray-dark-v1 mb-0">{{ $user->name }}</h5>
                                    <li class="list-inline-item ml-auto">
                                        @auth
                                        @if($user->id != Auth::user()->id)
                                        <follow-component :user="{{ json_encode($user) }}"></follow-component>
                                        @endif
                                        @endauth
                                    </li>
                                </ul>
                                <span class="g-color-gray-dark-v4 g-font-size-12">{{ $user->email }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-center">{{ $user->followers()->latest()->paginate(10)->links() }}</div>
</div>
@endsection

<style>
    body {
        background: #eee;
        margin-top: 20px;
    }

    html body .m-t-30 {
        margin-top: 30px;
    }

    html body .m-t-10 {
        margin-top: 10px;
    }

    html body .font-medium {
        font-weight: 500;
    }

    .img-circle {
        border-radius: 100%;
    }

    h4 {
        line-height: 22px;
        font-size: 18px;
    }

    .card .card-subtitle {
        font-weight: 300;
        margin-bottom: 15px;
        color: #99abb4;
    }

    a.link {
        color: #455a64;
    }



    .btn-circle {
        border-radius: 100%;
        width: 40px;
        height: 40px;
        padding: 10px;
    }

    .btn {
        padding: 7px 12px;
        cursor: pointer;
    }









    @media (min-width: 0) {
        .g-mr-15 {
            margin-right: 1.07143rem !important;
        }
    }

    @media (min-width: 0) {
        .g-mt-3 {
            margin-top: 0.2142229rem !important;
        }
    }

    .g-height-50 {
        height: 50px;
    }

    .g-width-50 {
        width: 50px !important;
    }

    @media (min-width: 0) {
        .g-pa-30 {
            padding: 2.14286rem !important;
        }
    }

    .g-bg-secondary {
        background-color: #ffffff !important;
    }

    .u-shadow-v18 {
        box-shadow: 0 5px 10px -6px rgba(0, 0, 0, 0.15);
    }

    .g-color-gray-dark-v4 {
        color: #777 !important;
    }

    .g-font-size-12 {
        font-size: 0.85714rem !important;
    }
</style>