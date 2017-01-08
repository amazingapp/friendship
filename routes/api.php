<?php

use App\Post;
use App\Transformers\Timeline as Timeliner;
use App\Traits\Timeline;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
Route::get('@{employee}/timeline', 'API\TimelineController@index');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
Route::post('posts/{post}/comment', 'API\CommentsController@create')->name('leave.comments');

Route::get('posts/{post}/comments', function(Post $post, Request $request) {
    $time = Carbon::createFromTimestamp( $request->get('timestamp', Carbon::now()->timestamp) );
    $comments = $post->comments()
                    ->with('user')
                    ->where('created_at','<', $time)
                    ->latest()
                    ->take(5)
                    ->get();
    if( ! $comments->count() )
    {
        return response()->json(['code' => '77', 'message' => 'No Record found.']);
    }
    $result = $comments->map(function($comment) use($time){
         return [
                'profile_picture'  =>  '/images/32.png',
                'user_name' => $comment->user->name,
                'timestamp' => $time->timestamp,
                'message' => $comment->message
            ];
    });

    return response()->json(['last_timestamp' => $result->first()['timestamp'], 'users' => $result]);
});