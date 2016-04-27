<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegistrationTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use DatabaseTransactions;
    use WithoutMiddleware;


    public function testNewAdminRegistration()
    {
        $baseUrl = 'http://localhost:8000/apicarasa/createadmin';
        $this->post($baseUrl, ['username' => 'qsuf', 'password' => '123456', 'email' => 'test@loststation.com', 'name' => 'bandcamp','address'=>'biji','mobile'=>'4957347'])
              ->seeJson([
                 'message' =>"Create Admin Success!",
             ]);
    }
}
?>
