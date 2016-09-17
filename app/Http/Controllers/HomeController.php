<?php

namespace App\Http\Controllers;

use App\Post;
use App\Traits\Timeline;
use Auth;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    use Timeline;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $posts = $this->getTimelineFor($user)->paginate(5);
        return view('home', compact('user', 'posts'));
    }
}
