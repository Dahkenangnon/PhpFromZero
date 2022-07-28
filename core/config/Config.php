<?php


namespace PhpFromZero\Config;

use PhpFromZero\Error\ConfigurationError;

/**
 * Configuration variables container
 *
 * @author Justin Dah-kenangnon <dah.kenangnon@gmail.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://Justin.Dah-kenangnon.com
 * @link https://Paonit.com
 * @link https://Dah-kenangnon.com
 */
class Config
{

    /**
     * @var array Database infos
     */
    protected $database;

    /**
     * @var String Application environnment
     * 
     * Can be production or developpment
     */
    protected $env;

    /**
     * @var String Project root directory
     */
    protected $projectDir;

    /**
     * @var array Parameters container
     * 
     */
    protected $params;


    /**
     * @var array All configuration variables
     */
    protected $container;


    /**
     * @var string Server base url
     */
    protected $baseUrl;



    public function __construct()
    {
        // The ReflectionObject will allow us find information about this class
        $r = new \ReflectionObject($this);

        $dir = $r->getFileName();

        // Getting config var from the environnement file
        if (is_file(dirname($dir, 3) . "/env.local.php")) {
            $this->container =  include(dirname($dir, 3) . "/env.local.php");
        } else if (is_file(dirname($dir, 3) . "/env.php")) {
            $this->container =  include(dirname($dir, 3) . "/env.php");
        } else  {
            throw new ConfigurationError("Environnement file env.local.php or env.php not found in the project root dir", 1);
        }

        // Make sure the top level `params` key exists in the container
        if (!$this->has('params')) {

            throw new ConfigurationError("Params not found", 1);
        }
        $this->params = $this->container['params'];


        // Make your the top level `database` key exists in the container
        if (!$this->has('database')) {

            throw new ConfigurationError("Database infos not found", 1);
        }
        $this->database = $this->container['database'];

        // Make sure the top level `env` key exist in the container
        if (!$this->has('env')) {

            throw new ConfigurationError("Env not found", 1);
        }
        $this->env = $this->container['env'];


        // Make sure the top level `baseurl` key exist in the container
        if (!$this->has('baseurl')) {

            throw new ConfigurationError("baseurl not found", 1);
        }
        $this->baseUrl = $this->container['baseurl'];
    }




    /**
     * Check if an entry exist in the configuration
     *
     * @param String  $key The param entry name
     * 
     * @param bool  $isParam Whether key is concerned params or top level config var
     * 
     * @return bool
     * 
     */
    public function has($key, $isParam = false): bool
    {
        if (!$isParam) {
            return isset($this->container[$key]) ? true : false;
        } else {
            return isset($this->params[$key]) ? true : false;
        }
    }


    /**
     * Get a top level entry variable in the config
     *
     * @param String  $varName
     * 
     * @return mixed
     */
    public function get(String $varName)
    {
        // Make sure the  entry exists before attempting to get it
        if (!$this->has($varName)) {

            throw new ConfigurationError("$varName not found in your configuration", 1);
        }
        return $this->container[$varName];
    }



    /**
     * Get a params entry
     *
     * @param String  $paramName
     * 
     * @return mixed
     */
    public function getParams(String $paramName)
    {
        // Make sure the param entry exists before attempting to get it
        if (!$this->has($paramName, true)) {

            throw new ConfigurationError("$paramName not found in your params", 1);
        }
        return $this->params[$paramName];
    }

    /**
     * Get database infos
     *
     * @return  array
     */
    public function getDatabase()
    {
        return $this->database;
    }


    /**
     * Get application environnment
     *
     * @return  String
     */
    public function getEnv()
    {
        return $this->env;
    }


    /**
     * Get the project root dir
     * 
     * @return String
     */
    public function getProjectDir()
    {
        // Make sure that the properties is not already set
        if (null === $this->projectDir) {

            // Create a new ReflectionObject linked to the current object
            $r = new \ReflectionObject($this);

            // Make sure we can get this class file name
            if (!is_file($dir = $r->getFileName())) {
                throw new ConfigurationError(sprintf('Cannot auto-detect project dir of class "%s".', $r->name));
            }


            // Get the parents directory of this file
            $dir = $rootDir = \dirname($dir);


            // What happen here ?
            //  1. $dir contains the current parent directoy path
            //  2. Using it to get the `env.local.php`, is_file() tells us whether the filename is a regular file
            //  3. We loop by going up while can get the file
            //  4. When found, it parent directory is the rootDir or our projectDir
            while (!is_file($dir . '/env.local.php')) {

                // If $dir is the parent folder and a valid related to `env.local.php`, it's Ok, return
                if ($dir === \dirname($dir)) {
                    return $this->projectDir = $rootDir;
                }

                // Unless, get it parent directory path
                $dir = \dirname($dir);
            }

            // Notice: If the file exist in our file system of the computer, we will get certainly the projectDir
            // Otherwise, Exception will be thrown as we will be at the computer root dir: C:/ (On Windows) or / (on unix base Os)
            $this->projectDir = $dir;
        }

        return $this->projectDir;
    }



    /**
     * Get all configuration variables in a single array
     *
     * @return  array
     */
    public function getcontainer()
    {
        return $this->container;
    }

    /**
     * Get the public folder dir
     * 
     * This can be use for example to server asset in our .ep.php templates
     *
     * @return  string
     */
    public function getPublicDir()
    {
        return $this->getProjectDir() . "/public";
    }

    /**
     * Get server base url
     *
     * @return  string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }
}
