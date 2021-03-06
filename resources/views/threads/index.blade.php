@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @forelse ($threads as $thread )
                    <div class="mb-4 card">
                        <div class="card-header">
                            <div class="level">
                                <h4 class="flex"><a href="{{ $thread->path() }}">
                                        {{ $thread->title }}
                                    </a>
                                </h4>
                                <a href="{{ $thread->path() }}"> {{ $thread->replies_count }}
                                    {{ Str::plural('reply', $thread->replies_count) }} </a>
                            </div>
                        </div>

                        <div class="card-body">{{ $thread->body }}</div>
                    </div>
                @empty
                    There are no threads
                @endforelse
            </div>
        </div>
    </div>
@endsection
