<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class Hellotest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use DatabaseMigrations;
    public function testHello()
   {
       $this->assertTrue(true);

       $response = $this->get('/');
       $response->assertStatus(404);
      
       $response = $this->get('/hello');
       $response->assertStatus(302);
      
       $user = factory(User::class)->create();
       $response = $this->actingAs($user)->get('/hello');
       $response->assertStatus(200);

       $response = $this->get('/no_route');
       $response->assertStatus(404);
   }
}
