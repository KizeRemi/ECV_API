<?php
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL\Query\QueryBuilder;

$app->get('/', function(Request $request) use ($app){
  
  $q = $request->query->get("q");
  return new JsonResponse(["ok" => $q], 200);
});