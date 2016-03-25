<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class NodesListTest extends TestCase {

    /**
     * Test nodes page.
     * 
     * @return void
     */
    function testAll()
    {
        // Test first seed result.
        $arr = $this->get('v1/nodes')->seeJson([
            'ip' => '127.0.0.1'
        ]);
        // Test first offset seed result.
        $arr = $this->get('v1/nodes', ['offset' => 1])->seeJson([
            'ip' => '8.8.8.8'
        ]);
        $this->assertResponseOk();
    }

    /**
     * Test region search.
     * @return void
     */
    function testRegion() 
    {
        // IP registered with Puerto Rico region is localhost.
        $arr = $this->get('v1/nodes', ['region' => 'Puerto Rico'])->seeJson([
            'ip' => '127.0.0.1'
        ]);

        // Listed Google's PDNS IP :D
        $arr = $this->get('v1/nodes', ['region' => 'California'])->seeJson([
            'ip' => '8.8.8.8'
        ]);
    }

    /**
     * Test node id search.
     * @return void
     */
    function testById() 
    {
        // IP registered with Puerto Rico region is localhost.
        // ID is 1.
        $arr = $this->get('v1/nodes/1')->seeJson([
            'ip' => '127.0.0.1'
        ]);
    }


    /**
     * Test latitude and longitude with preser values for seeded nodes.
     * @return void
     */
    function testLatLong() 
    {
        $arr = $this->get('v1/nodes', ['region' => 'Puerto Rico', 'latitude' => 18.2341200, 'longitude' => -66.0485000])->seeJson([
            'ip' => '127.0.0.1'
        ]);
    }
}
