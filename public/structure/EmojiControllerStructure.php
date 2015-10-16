<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 10/16/15
 * Time: 2:34 PM
 */

namespace Yemisi\Structure;

/**
 * Interface EmojiControllerStructure
 * @package Yemisi\Structure
 */
interface EmojiControllerStructure {

    /**
     * @param $app
     */
    public function getAllEmojiz($app);

    /**
     * @param $id
     * @param $app
     */
    public function getOneEmoji($id, $app);

    /**
     * @param $app
     */
    public function addNewEmoji($app);

    /**
     * @param $id
     * @param $app
     */
    public function editOneEmoji($id, $app);

    /**
     * @param $id
     * @param $app
     */
    public function deleteOneEmoji($id, $app);

}