<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class StatusTest extends TestCase
{
    /**
     * Tests the /status/ping page.
     *
     * @return void
     */
    public function testPing()
    {
        $this->get('v1/status/ping')
            ->seeJson([
                'pong' => true
            ]);
        $this->assertEquals(200, $response->status());
    }
}
