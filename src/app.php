<?php

$app = new \Slim\Slim();

//Create HTTP End points

//Webservice Landing page.
$app->get('/', function()
{
	require_once realpath(__DIR__.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'NewLogin.html');
});

//End point to web authenticate user to our webservice.
$app->post('/auth', function()
{
    new \Views\VerifyLogin();
});




//Create API End Points

//Landing API page
$app->get('/api/', function()
{
    require_once realpath(__DIR__.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'API_Directions.html');
});



//Authentication point for our webservice
$app->post('/api/auth', function()
{
    $test = new \Common\Authentication\InSqLite();
    $response = $test->authenticate(htmlentities($_POST['username']),htmlentities($_POST['password']));
    return $response;
});



$app->run();