<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostsRequest;
use App\Http\Requests\UpdatePostsRequest;
use App\Http\Resources\Post\IndexResource;
use App\Http\Resources\Post\ShowResource;
use Fouladgar\EloquentBuilder\EloquentBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(!auth('sanctum')->check()) {
            if($request->input('category') != null) {
                 $posts = Posts::where('category_id', $request->input('category'))->where('status', 100)->paginate(10);
                 return IndexResource::collection($posts);
             }

             return IndexResource::collection(Posts::where('status', 100)->paginate(15));
        } else {
            return IndexResource::collection(Posts::paginate(15));
        }



    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostsRequest $request)
    {
        $post = new Posts();
        $post->category_id = $request->input('category');
        $post->user_id = $request->user()->id;
        $post ->title = $request->input('title');
        if($request->input('thumbnail') != null) {
            $post->thumbnail = $request->input('thumbnail');
        }
        if($request->input('content') != null) {
            $post->content = $request->input('content');
        }
        $post->status = $request->input('status') ? Posts::STATUS[$request->input('status')] : 1;
        $post->save();

        return new ShowResource($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Posts $posts)
    {
        return new ShowResource($posts);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostsRequest $request, Posts $posts)
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
            $posts->status = Posts::STATUS[$request->input('status')];
        }

        $posts->save();

        return new ShowResource($posts);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Posts $posts)
    {
        $posts->delete();

        return response()->noContent();
    }
}
