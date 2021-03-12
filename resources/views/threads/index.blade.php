@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Forum</div>

                    <div class="card-body">
                        @foreach ($threads as $thread)
                            <article class="mb-4">
                                <a href="{{$thread->path()}}" >
                                    <h4 class="mb-3">{{ $thread->title }}</h4>
                                </a>
                                <div class="body">{{ $thread->body }}</div>
                            </article>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
