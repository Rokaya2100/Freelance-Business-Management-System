<?php

namespace App\Http\Controllers\Api;

use auth;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;


class CommentController extends Controller
{
    use jsonTrait;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-comment|edit-comment|delete-comment|comments-list', ['only' => ['index','show']]);
        $this->middleware('permission:create-comment', ['only' => ['store']]);
        $this->middleware('permission:edit-comment', ['only' => ['update']]);
        $this->middleware('permission:delete-comment', ['only' => ['destroy']]);
    }

   // show all comments for a specific project
    public function index($projectId)
    {

        $comments = Comment::where('project_id', $projectId)->with('project')->get();

        return $this->jsonResponse(200, 'All comments for the specified project retrieved successfully', $comments);
    }

    //show one comment
    public function show($id)
    {
        $comment = Comment::with('project')->findOrFail($id);
        return $this->jsonResponse(200, 'Comment retrieved successfully',$comment );
    }

    //create comment
    public function store(StoreCommentRequest $request)
{
    $validated = $request->validated();

    if (!auth()->check()) {
        return $this->jsonResponse(401, 'You must be logged in to create a comment',null );
    }

    $comment = new Comment();
    $comment->text = $validated['text'];
    $comment->project_id = $validated['project_id'];
    $comment->client_id = auth()->user()->id;
    $comment->save();

    return $this->jsonResponse(201, 'Comment created successfully',$comment );
}

    //update comment
public function update(Request $request, $id)
{
    if (!auth()->check()) {
        return $this->jsonResponse(401, 'You must be logged in to update a comment',null  );
    }

    $comment = Comment::findOrFail($id);

    if ($comment->client_id !== auth()->user()->id) {
        return $this->jsonResponse(403, 'You are not authorized to update this comment',null);
    }

    $comment->text = $request->text;
    $comment->project_id = $request->project_id;
    $comment->save();

    return $this->jsonResponse(200, 'Comment updated successfully',$comment );
}

    //delete comment
public function destroy($id)
{

    if (!auth()->check()) {
        return $this->jsonResponse(401, 'You must be logged in to delete a comment', null );
    }

    $comment = Comment::findOrFail($id);

    if ($comment->client_id !== auth()->user()->id) {
        return $this->jsonResponse(403, 'You are not authorized to delete this comment',null );
    }

    $comment->delete();

    return $this->jsonResponse(200, 'Comment deleted successfully',null );
}

}
