<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\PostsRequest;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function create(PostsRequest $request)
    {
        Post::create($request->only('user_id', 'message'));
        return back()->withFlashMessage('Your status has been posted.');
    }
}
