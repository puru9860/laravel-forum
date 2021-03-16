@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <div class="card mb-5 border-light">
                    <div class="card-header text-muted d-flex justify-content-between">
                        <h1>
                            {{ $profileUser->name }}
                        </h1>
                        <div class="">
                           Member since {{ $profileUser->created_at->format('y-m-d') }}
                        </div>
                    </div>

                </div>

                @foreach ($groupedActivities as $date => $activities)
                <h3 class="text-muted mb-3">{{$date}}</h3>
                    @foreach ($activities as $activity)
                        @include("profiles.activites.{$activity->type}")
                    @endforeach
                @endforeach

            </div>
        </div>
    </div>

@endsection
