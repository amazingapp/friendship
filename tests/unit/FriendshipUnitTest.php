<?php

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class FriendshipUnitTest extends MasterTestCase
{
    /** @test */
    public function it_should_send_a_request_to_another_friend()
    {
        $this->create('User', 2);
        $user = User::first();
        $anotherUser = User::where('id','<>', $user->id)->first();
        $user->addFriend($anotherUser);
        $this->assertTrue($anotherUser->hasFriendRequestReceived($user));
    }

    /** @test */
    public function it_should_receive_a_friend_request_and_accept_the_request()
    {
        $this->create('User',2);
        $user = User::first();
        $anotherUser = User::where('id','<>', $user->id)->first();
        $user->addFriend($anotherUser);
        $anotherUser->acceptFriendRequest($user);
        dd($user->isConnectedWith($anotherUser));
        $this->assertTrue($user->isConnectedWith($anotherUser));
    }
}
