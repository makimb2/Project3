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
    //require_once realpath(__DIR__.DIRECTORY_SEPARATOR.'Common'.DIRECTORY_SEPARATOR.'Authentication'.DIRECTORY_SEPARATOR.'InMemoryUser.php');
    $check = new \Common\Authentication\InMemoryUser();
    $check->authenticate(htmlentities($_POST['username']),htmlentities($_POST['password']));
});




//Create API End Points

//Landing API page
$app->get('/api/', function()
{
    require_once realpath(__DIR__.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'API_Info.html');
});



//Authentication point for our webservice
$app->post('/api/auth',  function() use($app)
{
    $test = new \Common\Authentication\InMemoryUser();
    $response = 401;
    
        $response = $test->authenticate(htmlentities($_POST['username']), $_POST['password']);
   
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