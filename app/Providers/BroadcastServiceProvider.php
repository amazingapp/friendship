<?php

namespace App\Providers;

use App\Traits\PostBroadcaster;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    use PostBroadcaster;
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();

        /*
         * Authenticate the user's personal channel...
         */
        Broadcast::channel('posts.*',function($user,$postId){
             return $this->isBroadcastable($postId, $user->id);
        });
        Broadcast::channel('chat-room.*', function ($user, $userId) {
            return  true; //(int) $user->id === (int) $userId;
        });
        Broadcast::channel('App.User.*',function($user,$postId){
             return true;
        });
    }
}
