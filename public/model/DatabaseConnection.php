<?php
/**
 * Created by PhpStorm.
 * User: Oduye Oluwayemisi
 * Date: 10/11/15
 * Time: 4:05 PM
 */

namespace Yemisi\Model;

use PDO;
use NotORM;
use PDOException;
use Dotenv\Dotenv;

/**
 * Class DatabaseConnection
 * @package Yemisi\Model
 */
abstract class DatabaseConnection {

    protected $engine;
    protected $name;
    protected $username;
    protected $password;

    /**
     *
     */
    public function __construct()
    {
        $this->loadDotEnv();
        $this->engine   = getenv('DB_ENGINE');
        $this->host     = getenv('DB_HOST');
        $this->name     = getenv('DB_NAME');
        $this->username = getenv('DB_USERNAME');
        $this->password = getenv('DB_PASSWORD');
    }

    /**
     * Method to load environment variables
     */
    protected function loadDotEnv(){
        $dotenv = new Dotenv(__DIR__ . '/../../');
        $dotenv->load();
    }

    /**
     * @return PDO|string
     *
     * Method to get the PDO class connection
     */
    public function getConnection()
    {
        try {
            return new PDO($this->engine . ":host=" . $this->host . ";dbname=" . $this->name, $this->username, $this->password);
        } catch (PDOException $e) {
            return "Connection to database failed: " . $e->getMessage();
        }
    }

    /**
     * @return NotORM
     *
     * Method to instantiate NotORM
     */
    public function databaseConnection()
    {
        return new NotORM($this->getConnection());
    }
}