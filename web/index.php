<?php
require_once(__DIR__."/../vendor/autoload.php");
use \GuzzleHttp\Client;

$client = new Client([
    'base_uri' => 'http://localhost:8888/API',
    'timeout'  => 2.0,
]);
$res = $client->get('/daily/car');
$result = json_decode($res->getBody()->__toString());
var_dump($result);