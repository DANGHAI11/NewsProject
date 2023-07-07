<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Services\CommentService;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function store(CommentRequest $request, Post $post)
    {
        $this->authorize('create', Comment::class);
        if ($this->commentService->createComment($request->all(), $post)) {
            return redirect()->back()->with('success', __('comment.create_success_comment'));
        }

        return redirect()->back()->with('error', __('comment.create_error_comment'));
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $this->authorize('update', $comment);
        if ($this->commentService->updateComment($request->all(), $comment)) {
            return redirect()->back()->with('success', __('comment.update_success_comment'));
        }

        return redirect()->back()->with('error', __('comment.update_error_comment'));
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        if ($this->commentService->deleteComment($comment)) {
            return redirect()->back()->with('success', __('comment.delete_success_comment'));
        }

        return redirect()->back()->with('error', __('comment.delete_error_comment'));
    }
}
