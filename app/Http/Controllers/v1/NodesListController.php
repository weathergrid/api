<?php

namespace App\Http\Controllers\v1;

use App\User;
use \App\Nodes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NodesListController extends Controller
{
    /**
     * Get some values before using functions.
     * 
     * @param Request $request [Instance of request.]
     */
    function __construct(Request $request) {
        // Rule number one of dev: never trust people, and typecast everything. <3
        $this->offset = (int) $request->input('offset', 0);
        // Set a sane limit.
        $this->limit = 5;
        $this->request = $request;
    }

    /**
     * List all nodes.
     * 
     * @param  Request $request [description]
     * @return [string]           [JSON containing list of nodes available.]
     */
    function all(Request $request) {
        // Try to request data...
        try {
            // Set a limit, and use the offset.
            $data =  Nodes::limit($this->limit)
                            ->offset($this->offset)
                            ->get();
            $success = true;
        } catch (\Exception $e) {
            return [
                'data' => [],
                'info' => [
                    'error' => 500,
                    'success' => false
                ]
            ];
        }

        return [
            'data' => $data,
            'success' => $success
        ];
    }
}