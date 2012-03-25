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
$app->get('/users/:user_id', function ($user_id = '') {
    echo json(Users::find($user_id));
});

$app->get('/users', function () {
    echo json(Users::findAll());
});

$app->get('/users/:user_id/definitions(/:definition_id)', function ($user_id, $definition_id = 'def') {
    echo "Hello, $user_id";
    echo "Hello, $definition_id";
});

$app->get('/definitions(/:definition_id)', function ($definition_id = '') {
    echo "Hello, $definition_id";
});

//POST route
$app->post('/person', function () {
    //Create new Person
});

//PUT route
$app->put('/person/:id', function ($id) {
    //Update Person identified by $id
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