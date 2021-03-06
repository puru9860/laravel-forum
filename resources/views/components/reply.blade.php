@props(['reply' => $reply])

<div id="reply-{{ $reply->id }}" class="card mb-3" >
    <div class="card-header">
        <div class="level">
            <div class="flex">
                <a href="{{ route('profile.show', $reply->user->name) }}" class="text">{{ $reply->user->name }} </a>
                said {{ $reply->created_at->diffForHumans() }}
            </div>
            <div>
                <form action="{{ route('favorites.store', $reply->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-secondary" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                        {{ $reply->favorites_count }} {{ Str::plural('Favorite', $reply->favorites_count) }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="card-body">
        {{ $reply->body }}
    </div>
    @can('update', $reply)
        <div class="card-footer d-flex">
            <form action="{{ route('replies.delete', $reply->id) }}" method="POST">
                @csrf
                @method('delete')
                {{-- <button class="btn btn-primary btn-sm">Edit</button> --}}
                <button class="btn btn-danger btn-sm">Delete</button>
            </form>
        </div>
    @endcan

</div>
<script>

</script>
