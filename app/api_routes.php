<?php
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


// Home
$app->get('/', function(Request $request) use ($app) {
	$q = $request->query->get("q");

	return new JsonResponse(["ok" => $q], 200);
});

// Get query
$app->get('/{query}', function(Request $request, $query) use ($app) {
	// Dailymotion
    $data = json_decode(file_get_contents('https://api.dailymotion.com/videos?tags=' . $query));

    echo 'lol';
	var_dump($data);
	die;

	$result = '';

	return new JsonResponse($result, 200);
});