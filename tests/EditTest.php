<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EditTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use DatabaseTransactions;
    use WithoutMiddleware;


    public function testNewAdminEdit()
    {
        $baseUrl = 'http://localhost:8000/apicarasa/editadmin';
         $this->put($baseUrl, ['id'=>'aiqx', 'name'=>'yusuf'])
              ->seeJson([
                 'message' =>"Edit Admin Success!",
             ]);
    }
}
?>