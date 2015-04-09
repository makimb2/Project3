<?php

$app = new \Slim\Slim();

//end point landing page
$app->get('/', function()
{
    require_once realpath(__DIR__.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'NewLogin.html');
});

$app->get('/e', function()
{
    require_once realpath(__DIR__.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'EnrollmentForm.html');
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


$app->post('/enroll',function () use($app) {


    $userIn = $app->request->params('username');
    $passIn = $app->request->params('password');
    $firstnameIn = $app->request->params('firstname');
    $lastnameIn = $app->request->params('lastname');

    $objSQLite = new \Common\Authentication\SQLiteConnection();
    $objSQLite->Enroll($userIn,$passIn, $firstnameIn, $lastnameIn);
});

$app->post('/api',function () use($app){


    $userIn = $app->request->params('username');
    $passIn = $app->request->params('password');


    $access = new \Common\Authentication\SQLiteConnection(); //change file here!

    if(!$access->authenticate($userIn,$passIn))//GENNA, this is assuming the authenticate function will return a true or false
    {
        $app->response()->setStatus(401);
        $app->response()->getStatus();

        return json_encode($app->response()->header('Blah Blah something something', 401));
    }
    if($access->authenticate($userIn,$passIn))
    {
        $app->response()->setStatus(200);
        $app->response()->getStatus();

        return json_encode($app->response()->header('SOmething about yay! you win! you authenticated. ', 200));
    }
});

$app->get('/access', function () {

    $objSQLite = new Common\Authentication\SQLiteConnection();
    $uuid = $objSQLite->GetTheUUID();

    $response = array();

    $response["error"] = false;
    $response["message"] = "Your UUID is : $uuid";
    echoRespnse(200, $response);
});

function echoRespnse($status_code, $response) {
    $app = \Slim\Slim::getInstance();
    // Http response code
    $app->status($status_code);
    echo json_encode($response);

}

$app->run();