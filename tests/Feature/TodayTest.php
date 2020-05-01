<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\News;
use App\Category;
use Carbon\Carbon;
use App\User;

class TodayTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
      // $st = '1';
      // $this->assertTrue(is_string($st));

      // $user = factory(User::class)->create();
      // $response = $this->actingAs($user)->get('/home');
      // // $response = $this->call('GET', '/home');
      // $response->assertStatus(200);
        // $response = $this->call('GET', '/home');

        // $categories = Category::where('user_id', 1)->get();
        // $category_id = array();
        // foreach ($categories as $category) {
        //   array_push($category_id, $category->id);
        // }
        // $data = News::where('created_at', '>', Carbon::today())
        //              ->whereIn('category_id', $category_id)
        //              ->paginate(10);

        // $this->assertEquals(302, $response->getStatusCode());
        // $data = $response->getData();
        // $this->assertEmpty($data);
        // $this->assertClassHasAttribute('', 'App\News');
        // print_r($response);
    }

    public function testAccsess()
    {
      (int) $a = 1;
      $this->assertTrue(is_numeric($a));
    }
}
