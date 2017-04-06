<?php
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Client;

// Home
$app->get('/', function(Request $request) use ($app) {
	$q = $request->query->get("q");

	return new JsonResponse(["ok" => $q], 200);
});

// Get query
// Get query
$app->get('/{query}', function(Request $request, $query) use ($app) {
	// Dailymotion
	$client = new Client([
	    'base_uri' => 'https://api.dailymotion.com',
	    'timeout'  => 2.0,
	]);
	$res = $client->get('/videos', [
	    'query' => ['tags' => $query]
	]);
	$result = json_decode($res->getBody()->__toString());
	
	return new JsonResponse($result, 200);
});