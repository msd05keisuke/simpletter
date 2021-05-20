@extends('layouts.app')

@section('content')
<div class="container">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <center class="m-t-30"> 
                        <img src="/uploads/avatars/{{ $user->avatar }}" class="img-circle" width="150">
                        <form enctype="multipart/form-data" action="/profile/{{ Auth::user()->id }}/edit" method="POST">
                            @csrf
                            <label>プロフィール画像の変更　</label><input type="file" name="avatar"><br>
                            @csrf
                            <label>名前の変更　</label><input class="card-title m-t-10" type="text" name="name" value="{{ $user->name }}"><br>
                            <button type="submit" class="btn btn-info ml-auto">保存</button>
                        </form>
                    </center>
                </div>
            </div>
        </div>
    </div>
                    
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