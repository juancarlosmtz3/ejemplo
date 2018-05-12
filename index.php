<?php

require 'vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);

$app->get('/clima', function (Request $request, Response $response, array $args) {
    
    $client = new \GuzzleHttp\Client();
    $res = $client->request('GET', 'http://api.openweathermap.org/data/2.5/weather?id=3529612&appid=9a8b7903ee8ea59c827c7ff32b9dfce5&units=metric');
 
    $body =  $res->getBody()->getContents();

    $json = json_decode($body,true);

    return $response->withJson($json);
});
$app->run();