<?php
namespace App\Traits;

use App\Post;
use App\User;

trait Timeline
{
    /**
     * get the posts of all the friends
     * @param  User   $user
     * @return \Eloquent\QueryBuilder
     */
    public function getTimelineFor(User $user)
    {
        return Post::with('user')
                    ->withCount('likes')
                    ->withCount('comments')
                    ->whereIn('user_id', $this->getFriendsIds($user) )
                    ->latest('created_at');
    }

    /**
     * Get the friends id with the user ids itself
     * @param   $user
     * @return array
     */
    protected function getFriendsIds($user)
    {
        return $user->getAcceptedFriendships()
                    ->transform(function ($friend) {
                        return [$friend->recipient_id, $friend->sender_id];
                    })
                ->flatten()
                ->unique();
    }
}
