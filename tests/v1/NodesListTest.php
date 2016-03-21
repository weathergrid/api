<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class NodesListTest extends TestCase
{
    /**
     * Test /nodes/list page.
     * 
     * @return void
     */
    function testList() {
        // Test first seed result.
        $arr = $this->get('v1/nodes/list/all')->seeJson([
            'success' => true,
            'ip' => '127.0.0.1'
        ]);
        // Test first offset seed result.
        $arr = $this->get('v1/nodes/list/all', ['offset' => 1])->seeJson([
            'success' => true,
            'ip' => '8.8.8.8'
        ]);
        $this->assertResponseOk();
    }
}
