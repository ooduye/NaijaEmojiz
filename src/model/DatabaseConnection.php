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
    protected $host;

    /**
     * Method to get enviroment variable and initialize them for use
     */
    public function initEnvData()
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
        if (! getenv('APP_ENV')) {
            $dotenv = new \Dotenv\Dotenv(__DIR__ . '/../../');
            $dotenv->load();
        }
    }

    /**
     * @return PDO|string
     *
     * Method to get the PDO class connection
     */
    public function getConnection()
    {
        $this->initEnvData();
        if ($this->engine === 'pgsql') {
            $dbConn = new PDO($this->engine . ':host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->name . ';user=' . $this->username . ';password=' . $this->password);
            $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbConn->setAttribute(PDO::ATTR_PERSISTENT, false);
        } elseif ($this->engine === 'mysql') {
            $dbConn = new PDO($this->engine . ':host=' . $this->host . ';dbname=' . $this->name . ';charset=utf8mb4', $this->username, $this->password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_PERSISTENT => false]);
        }
        return $dbConn;
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