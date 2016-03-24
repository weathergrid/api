<?php

namespace App\Http\Controllers\v1;

use App\User;
use \App\Nodes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ftxrc\Api\ApiController;
use App\Helpers\Helper;


/*
This is quite messy, but I'm on a deadline, need to get this done.
Refactor imminent!

TODO: Refactoring
 */

class NodesController extends Controller {
     use ApiController;

    /**
     * Get some values before using functions.
     * 
     * @param Request $request [Instance of request.]
     */
    public function __construct(Request $request)
    {
        // Rule number one of dev: never trust people, and typecast everything. <3
        $this->offset = (int) $request->input('offset', 0);

        // Set a sane limit.
        $this->limit = 5;
    }

    /**
     * Return result for id
     * @param  [int] $id [ID of node]
     * @return [string]     [JSON]
     */
    public function id($id) {
        // I really like typecasting.
        $id = (int) $id;
        try {
            $data =  Nodes::find($id);
            $response = $this->respond($data);
        } catch (\Exception $e) {
            $response = $this->respondServerError('Could not retrieve data from database.');
        }

        return $response;    
    }

    /**
     * List nodes.
     * 
     * @return [string] [JSON containing list of nodes, if sorted.]
     */
    public function list(Request $request)
    {
        $this->filters = [
            'region' => $request->input('region', null),
            'name' => $request->input('name', null),
            'ip' => $request->input('ip', null)
        ];

        $this->filters = array_filter($this->filters, function ($v) {
            return !is_null($v);
        });

        try {
            // use filters provided
            $data =  Nodes::limit($this->limit)->offset($this->offset);

            foreach ($this->filters as $filter => $value) {
                $data->where($filter, $value);
            }

            $data = $data->get();
            $response = $this->respond($data);
        } catch (\Exception $e) {
            $response = $this->respondServerError('Could not retrieve data from database.');
        }

        return $response;    
    }

    /**
     * Fetch nodes near coordinates given.
     * @return [type] [description]
     */
    public function near()
    {
        return Helper::calculateDistance([], []);
    }
}