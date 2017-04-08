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
$app->get('/daily/{query}', function(Request $request, $query) use ($app) {
	// Dailymotion
	$client = new Client([
	    'base_uri' => 'https://api.dailymotion.com',
	    'timeout'  => 2.0,
	]);
	$res = $client->get('/videos', [
	    'query' => ['search' => $query, 'limit' => 3]
	]);
	$result = json_decode($res->getBody()->__toString());

	return new JsonResponse($result, 200);
});

$app->get('/daily/user/{query}', function(Request $request, $query) use ($app) {
	// Dailymotion
	$client = new Client([
	    'base_uri' => 'https://api.dailymotion.com',
	    'timeout'  => 2.0,
	]);
	$res = $client->get('/user/'.$query);
	$result = json_decode($res->getBody()->__toString());

	return new JsonResponse($result, 200);
});


// Get query
$app->get('/deezer/{query}', function(Request $request, $query) use ($app) {
	// Deezer
	$client = new Client([
	    'base_uri' => 'https://api.deezer.com',
	    'timeout'  => 10.0,
	]);
	$res = $client->get('/search', [
	    'query' => ['q' => $query]
	]);
	$result = json_decode($res->getBody()->__toString());

	return new JsonResponse($result, 200);
});

$app->get('/bing/{query}', function(Request $request, $query) use ($app) {
	// Deezer
	$client = new Client([
	    'base_uri' => 'https://api.cognitive.microsoft.com',
	    'timeout'  => 10.0,
	]);
	$res = $client->get('/bing/v5.0/search',
		[
	    'query' => ['q' => $query],
	    'headers' => [
	        'Ocp-Apim-Subscription-Key' => '3c39a85131684fdfb6526c2b316b7c83',
	    ]
		]);
	$result = json_decode($res->getBody()->__toString());

	return new JsonResponse($result, 200);
});
