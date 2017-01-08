<?php

namespace App\Http\Controllers\API;

use App\Comment;
use App\Events\CommentWasPosted;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\CommentsRequest;
use App\Notifications\CommentNotification;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CommentsController extends Controller
{
    public function create(CommentsRequest $request)
    {
        $request->merge(['message' => $request->get('comment')]);

        $user = Auth::user();

        $post = Post::with('user')->find($request->get('post_id'));

        $comment = $post->comments()->create($request->only('message', 'user_id') );

        // $post->notify(new CommentNotification($user, $post, $comment) )->toOthers();

        return response()->json(['success' => true, 'comment' => 'you left a comment']);
    }
}
