<?php

/**
 * Step 1: Require the Slim PHP 5 Framework
 *
 * If using the default file layout, the `Slim/` directory
 * will already be on your include path. If you move the `Slim/`
 * directory elsewhere, ensure that it is added to your include path
 * or update this file path as needed.
 */
require 'Slim/Slim.php';
require "../classes/users.php";
require "../classes/definitions.php";

function json ($obj) {
    header('Content-Type', 'application/json');
    return json_encode($obj);
}
/**
 * Step 2: Instantiate the Slim application
 *
 * Here we instantiate the Slim application with its default settings.
 * However, we could also pass a key-value array of settings.
 * Refer to the online documentation for available settings.
 */
$app = new Slim();

/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, and `Slim::delete`
 * is an anonymous function. If you are using PHP < 5.3, the
 * second argument should be any variable that returns `true` for
 * `is_callable()`. An example GET route for PHP < 5.3 is:
 *
 * $app = new Slim();
 * $app->get('/hello/:name', 'myFunction');
 * function myFunction($name) { echo "Hello, $name"; }
 *
 * The routes below work with PHP >= 5.3.
 */

//GET route
    //Users
$app->get('/users/:_id', function ($_id = '') {
    echo json(User::find($_id));
});

$app->get('/users', function () {
    echo json(User::findAll());
});

    //Definitions
$app->get('/users/:user_id/definitions', function ($user_id) {
    $arrUser = User::find($user_id);
    $objUser = $arrUser[0];
    foreach ($objUser->getDefinitions() as $key => $var) {
        $arrId[] = $var['_id'];
    }
    echo json(Definition::find($arrId));
});    
    
$app->get('/definitions', function () {
    echo json(Definition::findAll());
});

//POST route
    //Users
$app->post('/users', function () use ($app) {
    $objUser = new User($app->request()->post('_id'), $app->request()->post('name'), $app->request()->post('email'), NULL);
    $result = $objUser->upsert();
    echo json($objUser);
});
    //Definitions
$app->post('/users/:user_id/definitions', function ($user_id) use ($app) {
    $objDefinition = new Definition(new MongoId(), $app->request()->post('name'), $app->request()->post('description'), $app->request()->post('elements'));
    $result = $objDefinition->upsert();
    $arrUser = User::find($user_id);
    $objUser = $arrUser[0];
    $arrDefinitions = $objUser->getDefinitions();
    $arrDefinitions[] = array("_id" => $objDefinition->getId(), "name" => $objDefinition->getName());
    $objUser->setDefinitions($arrDefinitions);
    $result = $objUser->upsert();
    echo json($objUser);
});    
    
//PUT route
$app->put('/users/:_id', function ($_id) use ($app) {
    $arrUsers = User::find($_id);
    $objUser = $arrUsers[0];
    $objUser->setName($app->request()->put('name'));
    $objUser->setEmail($app->request()->put('email'));
    $result = $objUser->upsert();
    echo json($objUser);
});

//DELETE route
$app->delete('/person/:id', function ($id) {
    //Delete Person identified by $id
});

/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This is responsible for executing
 * the Slim application using the settings and routes defined above.
 */
$app->run();