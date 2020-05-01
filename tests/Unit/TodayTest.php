<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class TodayTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
      $response = $this->call('GET', '/home');

      $this->assertEquals(302, $response->getStatusCode());

    }
}
