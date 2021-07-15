<?php

namespace PhpFromZero\Http;

use PhpFromZero\Http\Bag\Files;
use PhpFromZero\Http\Bag\Post;
use PhpFromZero\Http\Bag\Get;



/**
 * 
 * The HTTP request
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@epatriote.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://Creative.ePatriote.com
 * @link https://Dah-kenangnon.com
 */
class Request
{

    /**
     * @var Post 
     */
    protected $post;


    /**
     * @var Get
     */
    protected $get;

    /**
     * @var Files  
     */
    protected $files;


    /**
     * Method used to perform the request  $_SERVER['REQUEST_METHOD']
     * 
     * @var String
     */
    protected $method;


    /**
     * The request Url $_SERVER['REQUEST_URI'];
     * 
     * @var String 
     */
    protected $url;


    /**
     * The session
     * 
     * @var Session
     */
    protected $session;


    public function __construct()
    {
        $this->setGet(new Get())
            ->setPost(new Post())
            ->setFiles(new Files())
            ->setUrl($_SERVER['REQUEST_URI'])
            ->setMethod($_SERVER['REQUEST_METHOD'])
            ->setSession();
    }


    // Check whether there are file uploaded
    public function hasUploadedFile()
    {

        $files = $this->getFiles();

        return $files->isSet();
    }



    /**
     * Get the value of post
     *
     * @return  Post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set the value of post
     *
     * @param  Post  $post
     *
     * @return  self
     */
    public function setPost(Post $post)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get the value of get
     *
     * @return  Get
     */
    public function getGet()
    {
        return $this->get;
    }

    /**
     * Set the value of get
     *
     * @param  Get  $get
     *
     * @return  self
     */
    public function setGet(Get $get)
    {
        $this->get = $get;

        return $this;
    }

    /**
     * Get the value of files
     *
     * @return  Files
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * Set the value of files
     *
     * @param  Files  $files
     *
     * @return  self
     */
    public function setFiles(Files $files)
    {
        $this->files = $files;

        return $this;
    }


    /**
     * Get method used to perform the request $_SERVER['REQUEST_METHOD']
     *
     * @return  String
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set method used to perform the request $_SERVER['REQUEST_METHOD']
     *
     * @param  String  $method  Method used to perform the request $_SERVER['REQUEST_METHOD']
     *
     * @return  self
     */
    public function setMethod(String $method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Get the request Url $_SERVER['REQUEST_URI'];
     *
     * @return  String
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set the request Url $_SERVER['REQUEST_URI'];
     *
     * @param  String  $url  The request Url $_SERVER['REQUEST_URI'];
     *
     * @return  self
     */
    public function setUrl(String $url)
    {
        $this->url = $url;

        return $this;
    }


    /**
     * Get the session
     *
     * @return  Session
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Set the session
     *
     *
     * @return  self
     */
    public function setSession()
    {
        $this->session = Session::getInstance();

        return $this;
    }


     /**
     * Save the connected user in the session
     *
     * @param User $user The user to save
     *
     * @return  self
     */
    public function saveUser($user){
        $this->session->user = $user;
        return $this;
    }


     /**
     * Clear the connected user from the session
     *
     *
     * @return  self
     */
    public function deleteUser(){
        $this->session->user = null;
        return $this;
    }



     /**
     * Get the connected user
     *
     *
     * @return mixed
     */
    public function getUser(){
        return $this->session->user;
    }
}

