<?php
namespace App\Traits;

use App\Post;
use App\Traits\Timeline;

trait PostBroadcaster
{
    use Timeline;

    public function isBroadcastable($postId, $userId)
    {
        $creator = Post::find($postId)->user;
        return $this->getFriendsIds($creator)->contains($userId);
    }
}