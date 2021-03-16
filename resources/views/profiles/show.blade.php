@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <div class="card mb-5 border-light">
                    <div class="card-header text-muted">
                        <h1>
                            {{ $profileUser->name }}
                            <small>since {{ $profileUser->created_at->diffForHumans() }}</small>
                        </h1>
                    </div>

                </div>

                @foreach ($threads as $thread)
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between">
                            <span><a href="{{route('profile.show',$thread->user->name)}}">{{ $thread->user->name }}</a> </h5>
                                posted  <a href="{{$thread->path()}}"> {{ $thread->title }}</a>
                            </span>
                            <span>{{$thread->created_at->diffForHumans()}}</span>
                        </div>

                        <div class="card-body">{{ $thread->body }}</div>
                    </div>
                    <hr>
                @endforeach

                {{$threads->links()}}
            </div>
        </div>
    </div>

@endsection
