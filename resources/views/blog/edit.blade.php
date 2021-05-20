@extends('layouts.app')

@section('content')
<div class="container">
    <div class="center-block">
        <div class="well">
            @if ($errors->has('content'))
            <div style="color: red;">
                {{ $errors->first('content') }}
            </div>

            @if (session('err_msg'))
            <p class="text-danger">{{ session('err_msg') }}</p>
            @endif

            @endif
            <form accept-charset="UTF-8" method="POST" action="{{ route('update', $blog) }}">
                @csrf
                <textarea class="form-control" id="content" name="content" placeholder="Type in your message" rows="5">{{ $blog->content }}</textarea>
                <h6 class="pull-right" id="count_message"></h6>
                <button class="btn btn-info" type="submit">Edit</button>


            </form>
        </div>
    </div>
</div>
@endsection

<style>
    body {
        background: #eee;
    }

    #text {
        resize: none;
        margin-bottom: 10px;
    }
</style>