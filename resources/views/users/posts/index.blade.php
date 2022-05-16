@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <p class="text-red-500 text-bold">
                {{$user->name}} Posted: {{$posts->count()}} {{Str::plural('post', $posts->count())}}
                and received {{$user->receivedLikes()->count()}} {{Str::plural('like', $user->receivedLikes()->count())}}
            </p>
            @if ($posts->count())
                @foreach ($posts as $post)
                    <x-post :post="$post"/>
                @endforeach


                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
                {{ $posts->links('pagination::bootstrap-4') }}
            @else
                <p>{{ $user->name }}: There are no Posts yet!</p>
            @endif
        </div>
    </div>
@endsection
