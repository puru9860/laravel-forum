@component('profiles.activites.activity')
    @slot('heading')

        <a href="{{ route('profile.show', $profileUser->name) }}"><strong>{{ $profileUser->name }}</strong>
        </a>
        posted <a href="{{ $activity->subject->path() }}">{{ $activity->subject->title }}</a>

    @endslot


    @slot('body')

        {{ $activity->subject->body }}

    @endslot
@endcomponent
