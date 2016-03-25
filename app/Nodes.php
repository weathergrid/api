<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Location\Coordinate;
use Location\Distance\Vincenty;

class Nodes extends Model {
    /**
     * The nodes table.
     *
     * @var string
     */
    protected $table = 'nodes';

    /**
     * Get results from database, guiding by latlong and region.
     * 
     * Explanation: Doing this calculation to all results on the database is too intensive.
     * Vincenty's formula is very heavy, and I want to take this load off the database.
     * A smarter way is to take one extra argument, the region, select all results in the region,
     * and perform Vincenty's formulae in the programming language instead, on a more limited
     * set of results, achieving faster execution and less resource usage. 
     * This **** is epic, mate.
     * 
     * @param  [object] $coords     [A Coordinate entity (Dependency injection)]
     * @param  [string] $region     [A string containing the region.]
     * @param  [array] $options     [Options: radius, offset, limit. Note: radius to calculate to might have to be tweaked. Keep it sane.]
     * @return [array]              [Array containing the resulting nodes]
     */
    public static function getByLatLong(Coordinate $coords, string $region, $options = ['radius' => 17])
    {	
    	// Get nodes for the specified region...
    	$query = Self::where('region', $region);
    	$query = $query->get();
    	// Create the empty results array.
  	 	$results = [];
    	foreach ($query as $q) {
    		$dbc = new Coordinate($q->latitude, $q->longitude);
    		$distance = $coords->getDistance($dbc, new Vincenty());
    		// Convert the result in meters to miles...
    		$distance = $distance * 0.00062137;

    		// Sometimes we get insane numbers, round them to a whole number.
    		// This might end up slightly inaccurate, but it's okay, the inaccuracy range is pretty tight, it *should* be relatively precise.
    		// This rounds up, as the PHP default is `const PHP_ROUND_HALF_UP;`
    		// http://php.net/manual/en/function.round.php
    		$distance = round($distance);

    		// Find nodes that are within the default radius (from the starting coordinate)
    		if ($distance <= $options['radius'])
    		{
    			// Append into the results array.
    			$results[] = $q;
    		}
    	}
    	return $results;
    }	
}