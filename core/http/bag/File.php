<?php

namespace PhpFromZero\Http\Bag;


/**
 * Element of $_FILES array
 * 
 * Represent a file
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@gmail.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://LaSyntax.com
 */
class File
{

    /**
     * File name
     */
    private $name;

    /**
     * File type
     */
    private $type;


    /**
     * File temp_dir
     */
    private $temp_dir;


    /**
     * @see https://www.php.net/manual/en/features.file-upload.errors.php
     */
    private $error;


    /**
     * File size
     */
    private $size;


    public function __construct($fileData)
    {
        $this->setName($fileData['name']);
        $this->setType($fileData['type']);
        $this->setTempDir($fileData['temp_name']);
        $this->setError($fileData['error']);
        $this->setSize($fileData['size']);
    }


    /**
     * Get file name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set file name
     *
     * 
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get file type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set file type
     *
     * 
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get file temp_dir
     */
    public function getTempDir()
    {
        return $this->temp_dir;
    }

    /**
     * Set file temp_dir
     *
     * 
     */
    public function setTempDir($temp_dir)
    {
        $this->temp_dir = $temp_dir;

        return $this;
    }

    /**
     * Get the value of error
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Set the value of error
     *
     * 
     */
    public function setError($error)
    {
        $this->error = $error;

        return $this;
    }

    /**
     * Get file size
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set file size
     *
     * 
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }


}
