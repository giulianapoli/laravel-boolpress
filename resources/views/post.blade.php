@extends('layouts.app')

@section('content')

<div class="Container">
    <div class='row d-flex justify-content-center'>
        <div class="justify-content-center">

        <a href="{{route("posts.create")}}">Nuovo Post</a>
        @foreach($posts as $post)
        <h4>Post Author: {{$post->author}}</h4>
            <p>{{$post->title}}</p>
            <p>{{$post->postToPostInformation->description}}</p>
            <p>{{$post->postToCategory->title}}</p>
            @foreach($post->postToTag as $tag)

            <p>{{$tag->name}}</p>

            @endforeach

            <div class="">
                <a href="{{route("posts.edit", $post->id)}}">Aggiorna</a>
                <a href="{{route("posts.show", $post->id)}}">Vedi Dettagli</a>

                <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit">Elimina</button>
                  </form>
            </div>
            
            {{-- <form method="GET" action="{{ route('post.edit', $post) }}">
                @csrf
                @method("GET")
                <button type="submit" @if (!\Auth::check()) disabled @endif class="btn btn-warning float-left mr-4">Modifica</button>
            </form> --}}
            
        @endforeach
        </div>
    </div>
</div>
@endsection


