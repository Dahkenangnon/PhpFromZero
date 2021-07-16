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
 * @link https://Creative.ePatriote.com
 */
class Logger
{

    protected static $logDir;
    protected  $config;

    protected static $instance;

    public function __construct()
    {
        $this->config = new Config();
        self::$logDir  = $this->config->getProjectDir() . '/var/log/log.' . $this->config->getEnv() . '.log';
    }

    public static function init()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
    }

    public static function log($msg, $url, $status)
    {
        self::init();

        $date = date('d.m.Y h:i:s');
        $log = $msg . "  |Date: " . $date . "   |Route:  " . $url . "  |Status:  " . $status . "\n";
        error_log($log, 3, self::$logDir);
    }
}
