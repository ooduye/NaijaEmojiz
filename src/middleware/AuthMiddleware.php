<?php
/**
 * Created by PhpStorm.
 * User: Oduye Oluwayemisi
 * Date: 10/11/15
 * Time: 4:06 PM
 */

namespace Yemisi\Middleware;

use Yemisi\Model\DatabaseConnection;

/**
 * Class AuthMiddleware
 * @package Yemisi\Middleware
 */
class AuthMiddleware extends DatabaseConnection {

    /**
     * @param $app
     *
     * Middleware function to check if a user is authorized to access certain routes on the API
     */
    public function authentication($app) {

        $app->response()->header("Content-Type", "application/json");

        $db = $this->databaseConnection();

        $tokenAuth = $app->request->headers->get('Authorization');

        $user = $db->users()->where("token", $tokenAuth);

//        if ($user = $user->fetch()) {
//            if ($user['token'] === $tokenAuth) {
//                if ($user['token_expire'] >= date('Y-m-d H:i:s')) {
//                    echo json_encode(array(
//                        "status" => 401,
//                        "message" => "Token is expired. Please login again"
//                    ));
//                    $app->response->status(401);
//                    $app->stop();
//                }
//            }
//
//        } else {
//            echo json_encode(array(
//                "status" => 401,
//                "message" => "You are not authorized to use this service"
//            ));
//            $app->response->status(401);
//            $app->stop();
//        }
    }
}