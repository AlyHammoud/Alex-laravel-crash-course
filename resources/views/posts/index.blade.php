@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <form action="{{ route('posts') }}" method="POST" class="mb-4">
                @csrf
                <div class="mb-4">
                    <label for="body" class="sr-only">Body</label>
                    <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror" placeholder="Post Something!"></textarea>

                    @error('body')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Post</button>
                </div>
            </form>

            @if ($posts->count())
                @foreach ($posts as $post)
                    <div class="mb4">
                        <a href="" class="font-bold text-gray-900 text-decoration-none">{{ $post->user->name }}</a><span class="text-gray-600 text-small ml-4">{{ $post->created_at->diffForHumans() }}</span>
                        <p class="mb-2">{{ $post->body }}</p>

                        <div class="flex items-center mb-4">
                            @auth
                                <div class="mr-4">
                                <form action="{{ route('posts.likes', $post) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="text-blue-500">Delete</button>
                                </form>
                                </div>
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
                    
                
                        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
                    {{ $posts->links('pagination::bootstrap-4') }}
            @else
                <p>There are no Posts yet!</p>
            @endif
        </div>
    </div>
@endsection