<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// Define the v1 namespace and prefixes
$v1 = ['prefix' => 'v1', 'namespace' => ns('v1')];

$app->group($v1, function () use ($app) {

	// Well, lumen doesn't allow route group nesting, which is kind of annoying.
	// Therefore, old school grouping it is.
	// I'd make a pull request but I'm too lazy for that, besides, I'm on a deadline.	
	
	// Begin Status routes.
	$app->get('status/ping', 'StatusController@ping');

	// Begin NodesController routes
	$app->get('nodes', "NodesController@get");
	$app->get('nodes/near', "NodesController@near");
	$app->get('nodes/{id}', "NodesController@id");
	// TODO: Implement custom query system.
	// $app->get('nodes/query' "NodesController@query");

});