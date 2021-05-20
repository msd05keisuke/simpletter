@extends('layouts.app')

@section('content')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<div class="container">
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">

            <form action="/blog/search" method="GET">
                <div class="input-group">
                    @csrf
                    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" name="search" />
                    <button type="submit" class="btn btn-info ml-auto">search</button>
                </div>
            </form>

            @if (session('err_msg'))
            <div class="alert alert-success" role="alert">
            {{ session('err_msg') }}
            </div>
            @endif

            @foreach($blogs as $blog)
            <div class="card-body">
                <div class="col-md-12">

                    <div class="media g-mb-30 media-comment">
                        <a href="/profile/{{ $blog->user->id }}"><img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15" src="/uploads/avatars/{{ $blog->user->avatar }}" alt="Image Description"></a>
                        <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">


                            <div class="g-mb-15">
                                <ul class="list-inline d-sm-flex my-0">
                                    <h5 class="h5 g-color-gray-dark-v1 mb-0">{{ $blog->user->name }}</h5>
                                    <li class="list-inline-item ml-auto">
                                        @auth
                                        <!-- 自分のみ削除と編集を可能とする -->
                                        @if($blog->user->id == Auth::user()->id)
                                        <div class="dropdown">
                                            <i class="fa fa-ellipsis-h" style="color: gray;font-size:20px" 　type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                            　　
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{ route('edit', $blog->id) }}"><i class="fa fa-edit"></i>　Edit</a>
                                                <a class="dropdown-item" href="{{ route('delete', $blog->id) }}" onclick="return confirm('本当に削除しますか？')"><i class="fa fa-trash-o"></i>　Delete</a>
                                            </div>
                                        </div>
                                        @endif
                                        @endauth
                                    </li>

                                </ul>
                                <span class="g-color-gray-dark-v4 g-font-size-12">{{ $blog->created_at->diffForHumans() }}</span>
                            </div>

                            <p>{{ $blog->content }}</p>

                            <ul class="list-inline d-sm-flex my-0">
                                <like-component :blog="{{ json_encode($blog)}}"></like-component>
                                <li class="list-inline-item ml-auto">
                                    <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="/blog/comments/{{ $blog->id }}">
                                        <i class="fa fa-reply g-pos-rel g-top-1 g-mr-3">{{ $blog->comments->count() }}</i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-center">{{ $blogs->links() }}</div>
</div>
@endsection

<script>
    function checkDelete() {
        if (window.confirm('削除してよろしいですか？')) {
            return true;
        } else {
            return false;
        }
    }
</script>

<style>
    body {
        background: #eee;
        margin-top: 10px;
    }

    html body .m-t-30 {
        margin-top: 31px;
    }

    html body .m-t-10 {
        margin-top: 5px;
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
        margin-bottom: 5px;
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