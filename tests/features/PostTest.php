<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostTest extends MasterTestCase
{
    /** @test */
    public function it_should_post_a_post()
    {
        $this
            ->createUserAndLogin()
            ->visit('/home')
            ->type('My first Post!', 'message')
            ->press('Post')
            ->seePageIs('/home')
            ->see('Your status has been posted.')
            ->see('My first Post!');
    }
}
