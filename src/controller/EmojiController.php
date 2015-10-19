<?php
/**
 * Created by PhpStorm.
 * User: Oduye Oluwayemisi
 * Date: 10/11/15
 * Time: 4:25 PM
 */

namespace Yemisi\Controller;

use Yemisi\Model\DatabaseConnection;
use Yemisi\Structure\EmojiControllerStructure;

/**
 * Class EmojiController
 * @package Yemisi\Controller
 */
class EmojiController extends DatabaseConnection implements EmojiControllerStructure {

    /**
     * @param $app
     *
     * Method to get all the emojis from the database
     */
    public function getAllEmojiz($app) {

        $db = $this->databaseConnection();

        $emojiz = array();
        foreach($db->emojiz() as $emoji) {
            $emojiz[]  = array(
                "id" => $emoji["id"],
                "name" => $emoji["name"],
                "emoji_char" => $emoji["emoji_char"],
                'keywords' => explode(",", $emoji["keywords"]),
                "category" => $emoji["category"],
                "date_created" => $emoji["date_created"],
                "date_updated" => $emoji["date_updated"],
                "created_by" => $emoji["created_by"]
            );
        }
         echo json_encode($emojiz);
         $app->response->status(200);
    }

    /**
     * @param $id
     * @param $app
     *
     * Method to get a particular emoji from the database
     */
    public function getOneEmoji($id, $app) {

        $db = $this->databaseConnection();

        $emoji = $db->emojiz()->where("id", $id);

        if ($emoji = $emoji->fetch()) {
            echo json_encode(array(
                "id" => $emoji["id"],
                "name" => $emoji["name"],
                "emoji_char" => $emoji["emoji_char"],
                'keywords' => explode(",", $emoji["keywords"]),
                "category" => $emoji["category"],
                "date_created" => $emoji["date_created"],
                "date_updated" => $emoji["date_updated"],
                "created_by" => $emoji["created_by"]
            ));
        }
        else{
            echo json_encode(array(
                "status" => 404,
                "message" => "Emoji ID '$id' does not exist"
            ));
            $app->response->status(404);
        }
    }

    /**
     * @param $app
     *
     * Method to add a new emoji to the database
     */
    public function addNewEmoji($app) {

        $db = $this->databaseConnection();

        $tokenAuth = $app->request->headers->get('Authorization');

        $user = $db->users()->where("token", $tokenAuth);

        $user = $user->fetch();

        $username = $user['username'];

        $emoji = $app->request()->post();

        $emoji['created_by'] = $username;

        $result = $db->emojiz->insert($emoji);

        if ($result["id"] === NULL) {
            echo json_encode(array(
               "status" =>304,
                "message" =>"Emoji was not created"
            ));
            $app->response->status(304);
        } else {
            echo json_encode(array(
                "status" => 201,
                "id" => $result["id"]));
            $app->response->status(201);
        }
    }

    /**
     * @param $id
     * @param $app
     *
     * Method to edit a particular emoji from the database
     */
    public function editOneEmoji($id, $app) {

        $db = $this->databaseConnection();

        $emoji = $db->emojiz()->where("id", $id);

        if ($emoji->fetch()) {
            $post = $app->request()->put();
            $result = $emoji->update($post);

            if ($result["id"] === NULL) {
                echo json_encode(array(
                    "status" =>304,
                    "message" =>"Emoji was not updated"
                ));
                $app->response->status(304);
            } else {
                echo json_encode(array(
                    "status" => 200,
                    "message" => "Emoji $id updated successfully"
                ));
                $app->response->status(200);
            }


        }
        else{
            echo json_encode(array(
                "status" => 404,
                "message" => "Emoji id '$id' does not exist"
            ));
            $app->response->status(404);
        }
    }

    /**
     * @param $id
     * @param $app
     *
     * Method to delete a particular emoji from the database
     */
    public function deleteOneEmoji($id, $app) {

        $db = $this->databaseConnection();

        $emoji = $db->emojiz()->where("id", $id);

        if ($emoji->fetch()) {
            $result = $emoji->delete();

            if ($result["id"] === NULL) {
                echo json_encode(array(
                    "status" =>304,
                    "message" =>"Emoji was not deleted"
                ));
                $app->response->status(304);
            } else {
                echo json_encode(array(
                    "status" => 200,
                    "message" => "Emoji $id deleted successfully"
                ));
                $app->response->status(200);
            }
        }
        else{
            echo json_encode(array(
                "status" => 404,
                "message" => "Emoji id '$id' does not exist"
            ));
            $app->response->status(404);
        }
    }

}