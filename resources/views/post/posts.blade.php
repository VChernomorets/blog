@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row ">
            <div class="row">
                @forelse($posts as $post)
                    <div class="col-sm-3">
                        <div class="card">
                            <img class="card-img-top" alt="{{$post->header}}" src="/storage/{{$post->img}}">
                            <div class="card-body">
                                <h5 class="card-title"><a href="{{route('post.show', $post->id)}}">{{$post->header}}</a>
                                </h5>
                                <p class="card-text">{{$post->short_body}}</p>
                            </div>
                            <div class="card-footer text-muted">
                                <a href="{{route('user.posts', $post->user->id)}}">{{$post->user->name}}</a>
                                &bull;
                                {{$post->created_at}}
                                &bull;
                                <div class="like" likeType="post">
                                    Like: <span class="like__value">{{$post->like->count()}}</span>
                                    <div class="like__object
                                    @unless(!$post->like->contains('user_id', Auth::id()))
                                        like-active
                                    @endunless
                                        "
                                         status="{{$post->like->contains('user_id', Auth::id())}}"
                                         essenceId="{{$post->id}}">
                                        <i class="fas fa-heart"></i>
                                    </div>
                                </div>
                                @if(Auth::id() === $post->user->id)
                                <br>
                                    <a class="btn btn-primary" href="{{route('post.edit', $post->id)}}">Edit</a>
                                    <form action="{{route('post.delete', $post->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Нет постов.</p>
                @endforelse
            </div>
            <div class="row mt-5">
                <div class="col-auto">
                    {{ $posts->appends(['sortBy' => $sortBy, 'sortType' => $sortType])->links() }}
                </div>
            </div>
        </div>
@endsection
