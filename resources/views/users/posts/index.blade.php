@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            @foreach ($posts as $post)
                    <div class="mb4">
                        <a href="{{ route('users.post', $post->user) }}" class="font-bold text-gray-900 text-decoration-none">{{ $post->user->name }}</a><span class="text-gray-600 text-small ml-4">{{ $post->created_at->diffForHumans() }}</span>
                        <p class="mb-2">{{ $post->body }}</p>

                        <div class="flex items-center mb-4">
                            @auth

                            @can('delete', $post)
                                {{-- @if ($post->ownedBy(auth()->user()))   use as poolicy instead to only show delete button for me--}}
                                <div class="mr-4">
                                    <form action="{{ route('posts.destroy', $post) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="text-blue-500">Delete</button>
                                    </form>
                                </div>
                            @endcan
                                @if ($post->likedBy(auth()->user()))
                                <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-2">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="text-blue-500">Unlike</button>

                                    <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
                                </form>
                                @else
                                <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-2">
                                    @csrf
                                    <button type="submit" class="text-blue-500">Like</button>
                                </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                @endforeach
        </div>
    </div>
@endsection