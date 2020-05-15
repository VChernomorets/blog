@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row ">
            <div class="row">
                @forelse($posts as $post)
                    <div class="card w-25">
                        <img class="card-img-top" alt="..." src="https://images.unsplash.com/photo-1533425398081-0583e2d57c1c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80">
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{route('post.show', $post->id)}}">{{$post->header}}</a></h5>
                            <p class="card-text">{{$post->short_body}}</p>
                        </div>
                        <div class="card-footer text-muted">
                            {{$post->user->name}}
                            &bull;
                            {{$post->created_at}}
                        </div>
                    </div>
                @empty
                    <p>Нет постов.</p>
                @endforelse
            </div>
        </div>
@endsection
