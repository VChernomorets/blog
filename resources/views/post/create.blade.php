@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="header">Post name</label>
                    <input type="text" class="form-control" name="header" id="header" placeholder="Header">
                    <p class="text-danger">{{$errors->first('header')}}</p>
                </div>
                <div class="form-group">
                    <div class="input-file-row-1">
                        <div class="upload-file-container">
                            <img id="image" src="#" alt="" />
                            <div class="upload-file-container-text">
                                <span>Add<br />photo</span>
                                <input type="file" name="imgInput" class="photo" id="imgInput" />
                            </div>
                        </div>
                    </div>
                    <p class="text-danger">{{$errors->first('imgInput')}}</p>
                </div>
                <div class="form-group">
                    <label for="body">Body:</label>
                    <textarea class="form-control" name="body" id="body" rows="3"></textarea>
                    <p class="text-danger">{{$errors->first('body')}}</p>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection
