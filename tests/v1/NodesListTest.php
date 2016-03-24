<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class NodesListTest extends TestCase {

    /**
     * Test nodes/list/all page.
     * 
     * @return void
     */
    function testAll()
    {
        // Test first seed result.
        $arr = $this->get('v1/nodes/list/all')->seeJson([
            'ip' => '127.0.0.1'
        ]);
        // Test first offset seed result.
        $arr = $this->get('v1/nodes/list/all', ['offset' => 1])->seeJson([
            'ip' => '8.8.8.8'
        ]);
        $this->assertResponseOk();
    }

    /**
     * Test nodes/list/region search.
     * @return void
     */
    function testRegion() 
    {
        // IP registered with Puerto Rico region is localhost.
        $arr = $this->get('v1/nodes/list/region/Puerto_Rico')->seeJson([
            'ip' => '127.0.0.1'
        ]);

        // Listed Google's PDNS IP :D
        $arr = $this->get('v1/nodes/list/region/California')->seeJson([
            'ip' => '8.8.8.8'
        ]);
    }
    
}
