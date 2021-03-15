@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header d-flex ">
                        <h5 class="mr-1"><a href="{{route('profile.show',$thread->user->name)}}">{{ $thread->user->name }}</a> </h5>
                         posted {{ $thread->title }}
                    </div>

                    <div class="card-body">
                        {{ $thread->body }}
                    </div>
                </div>
                <div class="mb-4">
                    @foreach ($replies as $reply)
                        <x-reply :reply=$reply />
                    @endforeach

                    <div>{{ $replies->links() }}</div>
                </div>

                @auth
                    <form action="{{ route('replies.store', [$thread->channel->slug, $thread]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea name="body" id="body" class="form-control" rows="5" placeholder="Have something to say?"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Post</button>
                    </form>

                @endauth

                @guest
                    <p class="text-center">Please <a href="{{ route('login') }}">sign in </a>to participate discussion</p>
                @endguest
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        This thread was published {{ $thread->created_at->diffForHumans() }} by
                        <a href="{{route('profile.show',$thread->user->name)}}">{{ $thread->user->name }}</a> and currently has {{ $thread->replies_count }}
                        {{ Str::plural('comment', $thread->replies_count) }}
                    </div>
                </div>
            </div>
        </div>






    </div>
@endsection
