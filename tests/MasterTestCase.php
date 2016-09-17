<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class MasterTestCase extends TestCase
{
   use DatabaseMigrations;

   public function createUserAndLogin()
   {
       Auth::login($this->create('User'));
       return $this;
   }

   public function createUser( $data = [])
   {
     return factory('App\User')->create($data);
   }

   public function create($name, $times= 1, $data = [])
   {
       return factory('App\\' . $name, $times)->create($data);
   }
}
