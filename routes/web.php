<?php

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

// Route::get('/', function () {
    // DB::connection()->enableQueryLog();
    // $user = App\User::first();
    // $results = $user->posts()->with(['comments' => function($query){ $query->latest()->take(2); }])->paginate();
    // $queries = DB::getQueryLog();
    // dd($queries, $results);
// });

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');
Route::get('@{employee}/posts/{post}', 'PostsController@show')->name('posts.show');
Route::post('@{employee}/posts', 'PostsController@create')->name('posts.create');
Route::get('@{employee}', 'FriendsController@show')->name('friends.show');
Route::get('friends/requests', 'FriendsController@index')->name('friends.index');
Route::post('friends/requests', 'FriendsController@store')->name('friends.requests');
Route::post('friends/accept', 'FriendsController@update')->name('friends.accept');
Route::post('friends/decline', 'FriendsController@delete')->name('friends.decline');
Route::get('oauth/client/create', function() {
    return view('oauth.create-client');
});
