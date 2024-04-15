<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\Post\IndexResource;
use App\Http\Resources\Post\ShowResource;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       if($request->input('category') != null) {
            $posts = Post::where('category_id', $request->input('category'))->paginate(10);
            return IndexResource::collection($posts);
        }

        return IndexResource::collection(Post::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post();
        $post->category_id = $request->input('category');
        $post->user_id = $request->user()->id;
        $post ->title = $request->input('title');
        if($request->input('thumbnail') != null) {
            $post->thumbnail = $request->input('thumbnail');
        }
        if($request->input('content') != null) {
            $post->content = $request->input('content');
        }
        $post->status = $request->input('status') ? Post::STATUS[$request->input('status')] : 1;
        $post->save();

        return new ShowResource($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $posts)
    {
        return new ShowResource($posts);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $posts)
    {
        if($request->has('category')) {
            $posts->category_id = $request->input('category');
        }

        if($request->has('title')) {
            $posts->title = $request->input('title');
        }

        if($request->has('thumbnail')) {
            $posts->thumbnail = $request->input('thumbnail');
        }

        if($request->has('content')) {
            $posts->content = $request->input('content');
        }

        if($request->has('status')) {
            $posts->status = Post::STATUS[$request->input('status')];
        }

        $posts->save();

        return new ShowResource($posts);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $posts)
    {
        $posts->delete();

        return response()->noContent();
    }
}
