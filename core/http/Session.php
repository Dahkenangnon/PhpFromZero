<?php


namespace PhpFromZero\Http;

/**
 * 
 * The HTTP $_SESSION
 * 
 * Just call the static getInstance() method to get an instance of the class.
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@gmail.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://LaSyntax.com
 */
class Session
{
    // Sestion status constants
    const SESSION_STARTED = TRUE;
    const SESSION_NOT_STARTED = FALSE;
    
    // The state of the session
    private $sessionState = self::SESSION_NOT_STARTED;
    
    // The only instance of the class
    private static $instance;
    
    
    private function __construct() {}
    
   

    /**
     * Get The instance of 'Session'.
     * The session is automatically initialized if it wasn't.
     * 
     * @return object
     */
    public static function getInstance()
    {

        if (!isset(self::$instance))
        {
            self::$instance = new self;
        }

        // State the session
        self::$instance->startSession();
        
        return self::$instance;
    }
    
    
  

    
    /**
     * (Re)starts the session
     * 
     * @return bool True if the session has been initialized, False otherwise
     * 
     */
    public function startSession()
    {
        // If the session is not yet started previously, let's start it
        if ($this->sessionState == self::SESSION_NOT_STARTED )
        {
            $this->sessionState = session_start();
        }
        
        return $this->sessionState;
    }
    
    
    /**
     * Save data inside the session
     * 
     * Like: $instance->foo = 'bar';
     * 
     * @param $name The key in the session
     * 
     * @param $value the vaue linked the the previous key
     * 
     * @return void
     */
    public function __set( $name , $value )
    {
        $_SESSION[$name] = $value;
    }
    
    
    
    /**
     * Get data from the session
     * 
     * Like: echo $instance->foo;
     * 
     * @param $name The key of the data to get from the session
     * 
     * @return mixed
     */
    public function __get( $name )
    {
        if ( isset($_SESSION[$name]))
        {
            return $_SESSION[$name];
        }
    }
    
    
    /**
     * Check if a key is set in the session
     * 
     * Like:  Does `foo` exists in the session ?
     * 
     * @param $name The key of the data to check existence from the session
     * 
     * @return bool
     */
    public function __isset( $name )
    {
        return isset($_SESSION[$name]);
    }
    
    

    /**
     * Destroy a variable from the session
     * 
     * 
     * @param $name The key of the data to destroy in the session
     * 
     * @return void
     */
    public function __unset( $name )
    {
        unset($_SESSION[$name] );
    }
    
    
    
     /**
     * Destroy the current session
     * 
     * 
     * @return bool True is session has been deleted, else False.
     */
    public function destroy()
    {
        if ( $this->sessionState == self::SESSION_STARTED )
        {
            $this->sessionState = !session_destroy();

            unset( $_SESSION );
            
            return !$this->sessionState;
        }
        
        return FALSE;
    }
}