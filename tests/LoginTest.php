<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use DatabaseTransactions;
    use WithoutMiddleware;


    public function testNewLogin()
    {
        $baseUrl = 'http://localhost:8000/apicarasa/login';
        $this->post($baseUrl, ['username' => 'wenwie', 'password' => '123456'])
             ->seeJson([
                 'message' =>"Wrong username or password!",
             ]);
    }
}
?>