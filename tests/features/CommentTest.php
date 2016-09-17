<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CommentTest extends MasterTestCase
{
    /** @test */
    public function employee_can_comment_on_other_employee_status()
    {
        $user1 = $this->createUser();
        $user2 = $this->createUser();
        $user2->posts()->create(['message'=>'Hi, this is kabir maharjan.']);
        $user2->befriend($user1);
        $user1->acceptFriendRequest($user2);
        $this->actingAs($user1)
            ->visit('/@' . $user2->employee_id)
            ->type('My first Comment!', 'comment')
            ->press('Leave Comment')
            ->see('You left a comment.')
            ->seePageIs('/@' . $user2->employee_id);
    }

    /** @test */
    public function employee_can_delete_their_comment()
    {
        $user1 = $this->createUser();
        $user2 = $this->createUser();
        $user2->posts()->create(['message'=>'Hi, this is kabir maharjan.']);
        $user2->befriend($user1);
        $user1->acceptFriendRequest($user2);
         $this->actingAs($user1)
            ->visit('/@' . $user2->employee_id)
            ->type('My first Comment!', 'comment')
            ->press('Leave Comment')
            ->see('You left a comment.')
            ->press('#delete-comment')
            ->dontSee('My first Comment!');
    }
}
