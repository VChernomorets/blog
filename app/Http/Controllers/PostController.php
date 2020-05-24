<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostUpdate;
use App\Http\Requests\StorePost;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sortType = $request->sortType ?? 'created_at';
        $sortBy = $request->sortBy ?? 'asc';

        $posts = Post::orderBy($sortType, $sortBy)->paginate(8);
        return view('post.posts', ['posts' => $posts, 'sortBy' => $sortBy, 'sortType' => $sortType]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePost $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        //$request->validated();

        $post = new Post;
        $post->header = request('header');
        $post->body = request('body');
        $post->img = $request->file('imgInput')->store('uploads/post', 'public');
        $post->short_body = mb_strimwidth(request('body'), 0, 70, '...');
        $post->user_id = Auth::id();
        $post->save();

        return redirect()->route('posts');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $id)
    {
        return view('post.post', ['post' => $id, 'comments' => $id->comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $id)
    {
        $this->authorize('update', $id);
        return view('post.edit', ['post' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdate $request, $id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('update', $post);


        $post->header = request('header');
        $post->body = request('body');
        if(isset($request->imgInput)){
            $post->img = $request->file('imgInput')->store('uploads/post', 'public');
        }
        $post->short_body = mb_strimwidth(request('body'), 0, 70, '...');
        $post->save();

        return redirect(route('post.show', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $id)
    {
        $this->authorize('delete', $id);
        $id->delete();
        return redirect(route('posts'));
    }
}
