@component('profiles.activites.activity')
    @slot('heading')

        <a href="{{ route('profile.show', $profileUser->name) }}"><strong>{{ $profileUser->name }}</strong>
        </a>
        replied to thread <a href="{{ $activity->subject->thread->path() }}">{{ $activity->subject->thread->title }}</a>

    @endslot

    @slot('body')

        {{ $activity->subject->body }}

    @endslot
@endcomponent
