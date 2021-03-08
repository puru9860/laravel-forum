@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-5">
                <div class="card-header">{{$thread->title}}</div>

                <div class="card-body">
                    {{$thread->body}}
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($thread->replies as $reply)
            <div class="card mb-2">
                <div class="card-header">
                    <a href="#">{{$reply->user->name}}</a> said {{$reply->created_at->diffForHumans()}}
                </div>

                <div class="card-body">
                    {{$reply->body}}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
