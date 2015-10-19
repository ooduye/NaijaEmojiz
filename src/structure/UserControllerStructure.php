<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 10/16/15
 * Time: 2:35 PM
 */

namespace Yemisi\Structure;

/**
 * Interface UserControllerStructure
 * @package Yemisi\Structure
 */
interface UserControllerStructure {

    /**
     * @param $app
     */
    public function userLogin($app);

    /**
     * @param $app
     */
    public function userLogout($app);

}