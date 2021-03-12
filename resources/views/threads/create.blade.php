@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create a New Thread</div>

                    <div class="card-body">

                        <form action="{{ route('threads.store') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="channel_id">Choose a Channel</label>
                                <select class="form-control @error('channel_id') border-danger @enderror" name="channel_id"
                                    id="channel_id" oninput="changeToDefault('channel_id')" required>
                                    <option value="">Choose one</option>
                                    @foreach ($channels as $channel)
                                        <option value="{{ $channel->id }}"
                                            {{ old('channel_id') == $channel->id ? 'selected' : '' }}>
                                            {{ $channel->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('channel_id')
                                    <div class="text-danger mt-2 ">
                                        {{ $message }}s
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title"
                                    class="form-control @error('title') border-danger @enderror " placeholder=""
                                    oninput="changeToDefault('title')" value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="text-danger mt-2 ">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea class="form-control @error('body') border-danger @enderror" name="body" id="body"
                                    oninput="changeToDefault('body')" rows="6" required>{{ old('body') }}</textarea>
                                @error('body')
                                    <div class="text-danger mt-2 ">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function changeToDefault(id) {
            input = document.getElementById(id);
            input.className = "form-control"
        }

    </script>
@endsection
