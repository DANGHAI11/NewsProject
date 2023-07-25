<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\CommentRequest;
use App\Http\Requests\User\UpdateCommentRequest;
use App\Models\Comment;
use App\Services\User\CommentService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function store(CommentRequest $request)
    {
        $this->authorize('create', Comment::class);
        if ($this->commentService->createComment($request->all())) {
            $htmlComment = view('partials.comment', [
                'comments' => $this->commentService->getAllComment($request->post_id),
            ])->render();

            return Response::json([
                'htmlComment' => $htmlComment,
                'countComment' => $this->commentService->getAllComment($request->post_id, ['count' => true]),
                'message' => __('comment.create_success_comment'),
            ], 200);
        }

        return Response::json([
            'htmlComment' => '',
            'message' => __('comment.create_error_comment'),
        ], 400);
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $this->authorize('update', $comment);
        if ($this->commentService->updateComment($request->all(), $comment)) {
            return Response::json([
                'content' => $request->content,
                'message' => __('comment.update_success_comment'),
            ], 200);
        }
        
        return Response::json([
            'content' => "",
            'message' => __('comment.update_error_comment'),
        ], 400);
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        if ($this->commentService->deleteComment($comment)) {
            return redirect()->back()->with('success', __('comment.delete_success_comment'));
        }

        return redirect()->back()->with('error', __('comment.delete_error_comment'));
    }

    public function renderComment(Request $request)
    {
        $dataSearch = [
            'order' => $request->order,
        ];
        $htmlComment = view('partials.comment', [
            'comments' => $this->commentService->getAllComment($request->post_id, $dataSearch),
            'message' => ''
        ])->render();

        return Response::json([
            'html' => $htmlComment
        ], 200);
    }
}
