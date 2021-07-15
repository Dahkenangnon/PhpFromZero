<?php

namespace App\Entities;

use PhpFromZero\Entity\BaseEntity;

/**
 * Message Entity
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@epatriote.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://Creative.ePatriote.com
 * @link https://Dah-kenangnon.com
 */
class Message extends BaseEntity
{

    /**
     * @var String The message title
     */
    protected $title;

    /**
     * @var String The message content
     */
    protected $content;

    
    /**
     * @var int The User it who post the message 
     */
    protected $authorid;

    

    /**
     * Get the message title
     *
     * @return  String
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the message title
     *
     * @param  String  $title  The message title
     *
     * @return  self
     */ 
    public function setTitle(?String $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the message content
     *
     * @return  String
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the message content
     *
     * @param  String  $content  The message content
     *
     * @return  self
     */ 
    public function setContent(?String $content)
    {
        $this->content = $content;

        return $this;
    }


    /**
     * Get the User it who post the message
     *
     * @return  int
     */ 
    public function getAuthorid()
    {
        return $this->authorid;
    }

    /**
     * Set the User it who post the message
     *
     * @param  int  $authorid  The User it who post the message
     *
     * @return  self
     */ 
    public function setAuthorid(int $authorid)
    {
        $this->authorid = $authorid;

        return $this;
    }
}
