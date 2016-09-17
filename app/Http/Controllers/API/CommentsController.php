<?php

namespace App\Http\Controllers\API;

use App\Comment;
use App\Events\CommentWasPosted;
use App\Http\Requests;
use App\Http\Requests\CommentsRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CommentsController extends Controller
{
    public function create(CommentsRequest $request)
    {
        $request->merge(['message' => $request->get('comment')]);

        $comment = Comment::create($request->only('message', 'user_id', 'post_id'));

        broadcast(new CommentWasPosted($comment))->toOthers();

        return response()->json(['success' => true, 'comment' => 'you left a comment']);
    }
}
