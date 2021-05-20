@extends('layouts.app')

@section('content')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<div class="container">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="card-body">
                <div class="col-md-12">
                    <div class="media g-mb-30 media-comment">
                        <a href="/profile/{{ $blog->user->id }}"><img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15" src="/uploads/avatars/{{ $blog->user->avatar }}" alt="Image Description"></a>
                        <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                            <div class="g-mb-15">
                                <h5 class="h5 g-color-gray-dark-v1 mb-0">{{ $blog->user->name }}</h5>
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

                            <hr>

                            <div class="comment-wrapper">
                                <div class="panel panel-info">
                                    <div class="panel-body mt-4">
                                        @if ($errors->has('content'))
                                        <div style="color: red;">
                                            {{ $errors->first('content') }}
                                        </div>
                                        @endif
                                        <form accept-charset="UTF-8" method="POST" action="/blog/comments/{{ $blog->id }}">
                                            @csrf
                                            <textarea class="form-control" placeholder="write a comment..." rows="3" name="content" id="content"></textarea>
                                            <input type="hidden" name="blog_id" id="blog_id" value="{{ $blog->id }}">
                                            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                                            <br>
                                            <button type="submit" class="btn btn-info ml-auto">Comment</button>
                                        </form>
                                        <div class="clearfix"></div>
                                        <hr>
                                        @foreach($blog->comments()->latest()->paginate(10) as $comment)
                                        <ul class="media-list">
                                            <li class="media">
                                                <a href="/profile/{{ $comment->user_id }}" class="pull-left">
                                                    <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15" src="/uploads/avatars/{{ $comment->user->avatar }}" alt="Image Description">
                                                </a>
                                                <div class="media-body">
                                                    <span class="text-muted pull-right">
                                                        <!-- 自分の投稿したコメントまたは自分の投稿したブログに投稿されたコメントを削除可能とする -->
                                                        @if(Auth::user()->id == $comment->user->id || $blog->user->id == Auth::user()->id )
                                                        <div class="dropdown">
                                                            <i class="fa fa-ellipsis-h" style="color: gray;font-size:20px" 　type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item" href="{{ route('commentdelete', $comment->id) }}" onclick="return confirm('本当に削除しますか？')"><i class="fa fa-trash-o"></i>　Delete</a>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </span>
                                                    <strong>{{ $comment->user->name }}</strong><br>
                                                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                                    <p>
                                                        {{ $comment->content }}
                                                    </p>
                                                </div>
                                            </li>
                                        </ul>
                                        <p style="border-bottom: 2px dashed #efefef"></p>
                                        @endforeach
                                        <div class="d-flex align-items-center justify-content-center">{{ $blog->comments()->latest()->paginate(10)->links() }}</div>

                                    </div>
                                </div>
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