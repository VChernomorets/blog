@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <form method="post" action="{{route('post.update', $post->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="header">Post name</label>
                        <input type="text" class="form-control" name="header" id="header" placeholder="Header" value="{{$post->header}}">
                        <p class="text-danger">{{$errors->first('header')}}</p>
                    </div>
                    <fieldset>
                        <div class="input-file-row-1">
                            <div class="upload-file-container">
                                <img id="image" src="/storage/{{$post->img}}" alt="{{$post->header}}" />
                                <div class="upload-file-container-text">
                                    <span>Add<br />photo</span>
                                    <input type="file" name="imgInput" class="photo" id="imgInput" />
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group">
                        <label for="body">Body:</label>
                        <textarea class="form-control" name="body" id="body" rows="3">{{$post->body}}</textarea>
                        <p class="text-danger">{{$errors->first('body')}}</p>
                    </div>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
