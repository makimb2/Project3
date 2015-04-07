<?php

$app = new \Slim\Slim();

//end point landing page
$app->get('/', function()
{
	require_once realpath(__DIR__.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'NewLogin.html');
});

//End point to web authenticate user to our webservice.
//I don't think we will need the /auth endpoint anymore since now my login page calls /api
/*$app->post('/auth', function()
{

    $verify = new \Common\Authentication\NameOfOurSQLlightThing(); //HERE WE NEED TO CHANGE TO NAME OF SQLlight THING
    $verify->authenticate(htmlentities($_POST['username']),htmlentities($_POST['password']));
});*/

//Now endpoints for API

//point to authenticate web service


$app->post('/api',function () use($app){


    $userIn = $app->request->params('username');
    $passIn = $app->request->params('password');

    $access = new \Common\Authentication\NAMEOF_OUR_SQLLIGHT_thing($userIn,$passIn); //change file here!

    if($access->authenticate()!==1)//GENNA, this is assuming the authenticate function will return a true or false
    {
        $app->response()->setStatus(401);
        $app->response()->getStatus();
        return json_encode($app->response()->header('Blah Blah something something', 401));
    }
    if($access->authenticate()===1)
    {
        $app->response()->setStatus(200);
        $app->response()->getStatus();

        return json_encode($app->response()->header('SOmething about yay! you win! you authenticated. ', 200));
    }
});

$app->run();