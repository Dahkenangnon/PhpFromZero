<?php

namespace PhpFromZero\Utils;

use PhpFromZero\Config\Config;

/**
 * Logger application access & error
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@gmail.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://LaSyntax.com
 */
class Logger
{

    /**
     * @var string $logDir Directory to log in
     */
    protected static $logDir;


    /**
     * @var Config $config Config component
     */
    protected  $config;


    /**
     * @var self $instance This class instance
     */
    protected static $instance;


    public function __construct()
    {
        $this->config = new Config();
        self::$logDir  = $this->config->getProjectDir() . '/var/log/log.' . $this->config->getEnv() . '.log';
    }


    /**
     * Create a singleton
     * 
     * @var mixed Error message
     * @param string $url Where error happen
     * @param $status Status code
     * 
     * @return void 
     */
    public static function init()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
    }


    /**
     * Write log
     * 
     * @var mixed Error message
     * @param string $url Where error happen
     * @param $status Status code
     * 
     * @return void 
     */
    public static function log($msg, $url, $status)
    {
        self::init();

        $date = date('d.m.Y h:i:s');
        $log = $msg . "  |Date: " . $date . "   |Route:  " . $url . "  |Status:  " . $status . "\n";
        error_log($log, 3, self::$logDir);
    }
}
