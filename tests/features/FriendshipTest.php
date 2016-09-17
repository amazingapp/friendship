<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FriendshipTest extends MasterTestCase
{
    /** @test */
    public function it_should_send_friend_request()
    {
        $user = $this->createUser();
        $user2 = $this->createUser();
        $this->actingAs($user)
            ->visit('/@'. $user2->employee_id)
            ->press('Add as friend')
            ->seePageIs('/@'.$user2->employee_id)
            ->see('Friend request sent.');
    }

    /** @test */
    public function it_should_accept_friend_request()
    {
        $user1 = $this->createUser();
        $user2 = $this->createUser();
        $user1->befriend($user2);

        $this
            ->actingAs($user2)
            ->visit('/friends/requests')
            ->see('Respond to your 1 friend request')
            ->press('Confirm')
            ->see('You and ' . $user1->name. ' are friends.');
    }

    /** @test */
    public function it_should_reject_friend_request()
    {
        $user1 = $this->createUser();
        $user2 = $this->createUser();
        $user1->befriend($user2);

        $this
            ->actingAs($user2)
            ->visit('/friends/requests')
            ->see('Respond to your 1 friend request')
            ->press('Delete Request')
            ->see("You deleted request from {$user1->name}.");
    }
}
