@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img
                            src="/storage/{{$post->img}}"
                            class="card-img" alt="{{$post->header}}">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title">{{$post->header}}</h3>
                            <p class="card-text">{{$post->body}}</p>
                            <p class="card-text"><small class="text-muted">{{$post->created_at}}</small></p>
                        </div>
                    </div>
                </div>
                <div class="comment m-4">
                    <h4 class="m-2">Comments:</h4>
                    @forelse($comments as $comment)
                        <div class="card">
                            <h5 class="card-header">
                                <a href="{{route('user.posts', $comment->user->id)}}">{{$comment->user->name}}</a>
                            </h5>
                            <div class="card-body">
                                <p class="card-text">{{$comment->body}}</p>
                            </div>
                            <div class="card-footer">
                                <div class="like" likeType="comment">
                                    Like: <span class="like__value">{{$comment->like->count()}}</span>
                                    <div class="like__object
                                    @unless(!$comment->like->contains('user_id', Auth::id()))
                                        like-active
                                    @endunless
                                        "
                                         status="{{$comment->like->contains('user_id', Auth::id())}}"
                                         essenceId="{{$comment->id}}">
                                        <i class="fas fa-heart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>Пусто :(</p>
                    @endforelse
                    <form method="post" action="{{route('comment.store')}}">
                        @csrf
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <div class="form-group">
                            <label for="body">Add comment:</label>
                            <textarea class="form-control" name="body" id="body" rows="3"></textarea>
                            <p class="text-danger">{{$errors->first('body')}}</p>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>

        </div>
@endsection
