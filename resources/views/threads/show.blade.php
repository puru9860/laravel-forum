@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">

                        <a href="">{{ $thread->user->name }}</a> posted {{ $thread->title }}
                    </div>

                    <div class="card-body">
                        {{ $thread->body }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach ($thread->replies as $reply)
                    <x-reply :reply=$reply />
                @endforeach
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
        @auth

                    <form action="{{ route('replies.store', $thread) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea name="body" id="body" class="form-control" rows="5"> </textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Post</button>
                    </form>

        @endauth

        @guest
            <p class="text-center">Please <a href="{{route('login')}}">sign in </a>to participate discussion</p>
        @endguest
    </div>
</div>
    </div>
@endsection
