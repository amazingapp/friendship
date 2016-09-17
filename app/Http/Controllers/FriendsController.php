<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendsController extends Controller
{
    function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    /**
     * This handles the friends requests page
     * @return  view
     */
    public function index()
    {
        $friendRequests = Auth::user()->getFriendRequests();
        return view('friends.index', compact('friendRequests'));
    }

   public function show(User $employee)
   {
       $posts = $employee
                ->posts()
                    ->with(['comments' => function($query){
                        $query->latest()->take(2);
                    }])
                    ->with(['user'])
                    ->paginate();
       return view('friends.show', compact('employee', 'posts'));
   }

    /**
     * Responsible for accepting friend request
     * @param  Request $request [description]
     * @return redirect|back
     */
    public function update(Request $request)
    {
        $senderEmployeeId = $request->get('employee_id');
        $user = User::findByEmployeeId($senderEmployeeId);
        Auth::user()->acceptFriendRequest($user);
        return back()->withFlashMessage("You and {$user->name} are friends.");
    }

    /**
     * Responsible for requesting a friendship request
     * @param  User   $employee [description]
     * @return redirect|back
     */
    public function store( Request $request )
    {
        $user = Auth::user();
        $receipient = User::findByEmployeeId($request->get('employee_id') );
        $user->befriend($receipient);
        return back()->withFlashMessage('Friend request sent.');
    }

    /**
     * Responsible for rejecting any friendship request
     * @return redirect|back
     */
    public function delete(Request $request)
    {
        $senderEmployeeId = $request->get('employee_id');
        $user = User::findByEmployeeId($senderEmployeeId);
        Auth::user()->denyFriendRequest($user);
        return back()->withFlashMessage("You deleted request from {$user->name}.");
    }
}
