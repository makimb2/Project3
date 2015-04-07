<?php

$app = new \Slim\Slim();

//end point landing page
$app->get('/', function()
{
	require_once realpath(__DIR__.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'NewLogin.html');
});

//End point to web authenticate user to our webservice.

$app->post('/auth', function()
{

    $verify = new \Common\Authentication\NameOfOurSQLlightThing(); //HERE WE NEED TO CHANGE TO NAME OF SQLlight THING
    $verify->authenticate(htmlentities($_POST['username']),htmlentities($_POST['password']));
});

//Now endpoints for API

//point to authenticate web service
$app->post('/api/auth',  function() use($app)
{
    $access = new \Common\Authentication\NameOfOurSQLlightThing(); //HERE WE NEED TO CHANGE TO NAME OF SQLlight THING
    $response = 401;

    $response = $access->authenticate(htmlentities($_POST['username']), htmlentities($_POST['password']));

    if($response == 200)
    {
        return $app->response->status(200);
    }
    if($response == 401)
    {
        return $app->response->status(401);
    }
    return $app->response->status(500);
});

$app->run();