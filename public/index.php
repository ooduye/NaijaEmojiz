<?php

require_once "../vendor/autoload.php";

use Slim\Slim;
use Yemisi\Middleware\AuthMiddleware;
use Yemisi\Controller\UserController;
use Yemisi\Controller\EmojiController;

// New instance of AuthMiddleware class
$auth = new AuthMiddleware();

// New instance of UserController class
$user = new UserController();

// New instance of EmojiController class
$db = new EmojiController();

/**
 * Creating new instance of Slim framework
 */
$app = new Slim(array(
    "MODE" => "development",
    "TEMPLATES.PATH" => "./templates"
));

/**
 * Function to verify authorisation for certain routes
 */
$authentication = function () use ($app, $auth) {
    $auth->authentication($app);
};

/**
 * Function to prompt user that route does not exist
 */
$welcome = function() use ($app) {
    $app->response()->header("Content-Type", "application/json");
    echo json_encode("Welcome to NaijaEmojiz!!");
    $app->response->status(200);
};

/**
 * Function to get all Emojis
 */
$getAllEmojiz = function () use ($app, $db) {
    $app->response()->header("Content-Type", "application/json");
    $db->getAllEmojiz($app);
};

/**
 * @param $id
 *
 * Function to get a particular Emoji
 */
$getOneEmoji = function ($id) use ($app, $db) {
    $app->response()->header("Content-Type", "application/json");
    $db->getOneEmoji($id, $app);
};

/**
 * Function to add a new Emoji
 */
$addNewEmoji = function () use($app, $db) {
    $app->response()->header("Content-Type", "application/json");
    $db->addNewEmoji($app);
};

/**
 * @param $id
 *
 * Function to edit an Emoji
 */
$editOneEmoji = function ($id) use ($app, $db) {
    $app->response()->header("Content-Type", "application/json");
    $db->editOneEmoji($id, $app);
};

/**
 * @param $id
 *
 * Function to delete an Emoji
 */
$deleteOneEmoji = function ($id) use($app, $db) {
    $app->response()->header("Content-Type", "application/json");
    $db->deleteOneEmoji($id, $app);
};

/**
 * Function to log in a user
 */
$userLogin = function () use($app, $user) {
    $app->response()->header("Content-Type", "application/json");
    $user->userLogin($app);
};

/**
 * Function to log out a user
 */
$userLogout = function () use ($app, $user) {
    $app->response()->header("Content-Type", "application/json");
    $user->userLogout($app);

};

/**
 * Function to prompt user that route does not exist
 */
$pageNotFound = function() use ($app) {
    $app->response()->header("Content-Type", "application/json");
    echo json_encode(array(
        "status" => 404,
        "message" => "Route Not Found"));
    $app->response->status(404);
};


/**
 * Routes for NaijaEmojiz API
 */
$app->get("/", $welcome);

$app->get("/emojiz", $getAllEmojiz);

$app->get("/emoji/:id", $getOneEmoji);

$app->post("/emoji", $authentication, $addNewEmoji);

$app->put("/emoji/:id", $authentication, $editOneEmoji);

$app->patch("/emoji/:id", $authentication, $editOneEmoji);

$app->delete("/emoji/:id", $authentication, $deleteOneEmoji);

$app->notFound($pageNotFound);

$app->post("/login", $userLogin);

$app->get("/logout", $authentication, $userLogout);

/**
 * Method to run the application
 */
$app->run();
