@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <form action="{{route('replies.store',$thread)}}" method="POST">
                            @csrf
                            <input type="text" name="body">
                            <button type="submit">aa</button></form>
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
    </div>
@endsection
