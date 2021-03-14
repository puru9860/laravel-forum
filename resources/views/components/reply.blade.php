@props(['reply' => $reply])

<div class="card mb-3">
    <div class="card-header">
        <div class="level">
            <div class="flex">
                <a href="#" class="text">{{$reply->user->name }} </a> said {{$reply->created_at->diffForHumans()}}
            </div>
            <div>
                <form action="{{route('favorites.store',$reply->id)}}" method="POST">
                    @csrf
                    <button class="btn btn-secondary" {{$reply->isFavorited() ? 'disabled':''}}>
                        {{$reply->favorites_count}} {{Str::plural('Favorite',$reply->favorites_count)}} </button>
                </form>
            </div>
        </div>
    </div>

    <div class="card-body">
        {{$reply->body}}
    </div>
</div>
