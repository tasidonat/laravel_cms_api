<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\Comment\IndexResource;
use App\Http\Resources\Comment\ShowResource;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return IndexResource::collection(Comment::paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $comment = new Comment();
        $comment->post_id = $request->input('post');
        $comment->name = $request->input('name');
        $comment->email = $request->input('email');
        $comment->content = $request->input('content');
        $comment->status = 0;
        $comment->save();

        return new ShowResource($comment);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return new ShowResource($comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        if($request->has('post')) {
            $comment->post_id = $request->input('post');
        }

        if($request->has('name')) {
            $comment->name = $request->input('name');
        }

        if($request->has('email')) {
            $comment->email = $request->input('email');
        }

        if($request->has('content')) {
            $comment->content = $request->input('content');
        }

        if($request->has('status')) {
            $comment->status = Comment::STATUS[$request->input('status')];
        }
    
        $comment->save();

        return new ShowResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->noContent();
    }
}
