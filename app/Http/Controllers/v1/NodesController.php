<?php

namespace App\Http\Controllers\v1;

use App\Nodes,
    App\Http\Controllers\Controller,
    Ftxrc\Api\ApiController,
    Location\Coordinate,
    Illuminate\Http\Request;

/*
This is quite messy, but I'm on a deadline, need to get this done.
Refactor imminent!

Considered feature complete.

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

        try {
            // use filters provided
            $data =  Nodes::limit($this->limit)->offset($this->offset);

            foreach(['region', 'name', 'ip'] as $param) {
                if ($request->has($param)) {
                    $user->where($param, $request->input($param));
                }
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
     * @return string JSON result
     */
    public function near(Request $request)
    {
        if ($request->has('region') && $request->has('latitude') && $request->has('longitude'))
        {
            $region = $request->input('region');
            $latitude = $request->input('latitude');
            $longitude = $request->input('longitude');
        } 
        else
        {
            return $this->respondServerError('Not enough arguments supplied. Requires: region, latitude, longitude');
        }

        try
        {
            $coordinates = new Coordinate($latitude, $longitude);
            $result = Nodes::getByLatLong($coordinates, $region);
            // Remove keys from array, this prevents api inconsistencies.
            return $this->respond(array_values($result));
        }
        catch (\InvalidArgumentException $e)
        {
            return $this->respondServerError('Wrong latitude and longitude.');
        }
        //catch (\Exception $e)
        //{
        //   return $this->respondServerError("Unknown exception caught, could not retrieve value from database.");
       // }
    }
}