<?php

namespace PhpFromZero\Orm;

use PhpFromZero\Config\Config;
use PhpFromZero\Error\OrmError;

/**
 * Datase connection 
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@gmail.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://Creative.ePatriote.com
 */
class Database
{
    /**
     * The class instance
     */
    private static $_instance;

    /**
     *  @var \PDO
     */
    private $_connection;

    /**
     * @var Config The configuration container
     */
    protected $config;



    /**
     * Ensure we have a connection to mysql
     * 
     * @return self
     */
    public static function init()
    {
        try {
            if (is_null(self::$_instance) || empty(self::$_instance)) {
                self::$_instance = new self();
                return self::$_instance;
            } else {
                return self::$_instance;
            }
        } catch (\Exception $e) {

            print_r($e);
            return self::class;
        }
    }



    /**
     * Create a new PDO connection with the current project database information
     * 
     */
    function __construct()
    {
        $this->config = new Config();
        try {
            if (is_null($this->_connection) || empty($this->_connection)) {

                // Getting the database informations
                $infos = $this->config->getDatabase();

                // Create the PDO connection
                $this->_connection = new \PDO($infos['driver'] . ':host=' . $infos['host'] . ';dbname=' . $infos['database'], $infos['user'], $infos['password']);
            }
        } catch (\Exception $e) {

            // Throw error if impossible to connect the mysql with above credentials
            throw new OrmError($e->getMessage(), 1);
        }
    }


    /**
     * Return the database connection 
     * 
     * @return \PDO
     */
    public function connect(): \PDO
    {
        return $this->_connection ? $this->_connection : null;
    }
}
