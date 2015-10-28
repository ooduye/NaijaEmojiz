<?php
/**
 * Created by PhpStorm.
 * User: Oduye Oluwayemisi
 * Date: 10/16/15
 * Time: 12:08 PM
 */

namespace Yemisi\Controller;

use Yemisi\Model\DatabaseConnection;
use Yemisi\Structure\UserControllerStructure;

/**
 * Class UserController
 * @package Yemisi\Controller
 */
class UserController extends DatabaseConnection implements UserControllerStructure {

    /**
     * @param $app
     *
     * Method to log in user the API
     */
    public function userLogin($app) {

        $db = $this->databaseConnection();
        $pdo = $this->getConnection();

        $app->response()->header("Content-Type", "application/json");
        $username = $app->request->params('username');
        $password = $app->request->params('password');
        $user = $db->users()->where("username", $username);
        if ($user = $user->fetch()) {
            if ($user['username'] === $username && $user['password'] === $password) {
                $id = $user['id'];
                $name = $user['name'];
                $token = bin2hex(openssl_random_pseudo_bytes(16));
                $tokenExpiration = date('Y-m-d H:i:s', strtotime('+1 hour'));

                $count = $pdo->prepare("UPDATE users SET token = ?, token_expire = ? WHERE id = ?");
                $count->execute(array($token, $tokenExpiration, $id));

                $app->response()->header("Authorization", $token);

                echo json_encode(array(
                    "status" => 200,
                    "name" => $name,
                    "token" => $token
                ));
                $app->response->status(200);
            } else {
                echo json_encode(array(
                    "status" => 401,
                    "message" => "Incorrect password"
                ));
                $app->response->status(401);
            }
        }
        else {
            echo json_encode(array(
                "status" => 404,
                "message" => "Username '$username' does not exist"
            ));
            $app->response->status(404);
        }
    }

    /**
     * @param $app
     *
     * Method to log in user the API
     */
    public function registerUser($app) {

        $db = $this->databaseConnection();

        $user = $app->request()->post();

        $result = $db->users->insert($user);

        if ($result["id"] === NULL) {
            echo json_encode(array(
                "status" => 201,
                "message" => "User has been created"
            ));
            $app->response->status(201);
        } else {
            echo json_encode(array(
                "status" =>304,
                "message" =>"User was not created"
            ));
            $app->response->status(304);
        }
    }

    /**
     * @param $app
     *
     * Method to log out a user from the API
     */
    public function userLogout($app) {

        $db = $this->databaseConnection();
        $pdo = $this->getConnection();

        $tokenAuth = $app->request->headers->get('Authorization');
        $user = $db->users()->where("token", $tokenAuth);

        if ($user = $user->fetch()) {

            $id = $user['id'];

            $count = $pdo->prepare("UPDATE users SET token = NULL, token_expire = NULL WHERE id = ?");
            $count->execute(array($id));
    
            echo json_encode(array(
                "status" => 200,
                "message" => "You have been successfully logged out"
            ));
            $app->response->status(200);
        }
        else {
            echo json_encode(array(
                "status" => 404,
                "message" => "Token '$tokenAuth' is incorrect"
            ));
            $app->response->status(404);
        }

    }

}