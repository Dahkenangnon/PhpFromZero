<?php

namespace App\Entities;

use PhpFromZero\Entity\BaseEntity;

/**
 * User entity
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@epatriote.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://Creative.ePatriote.com
 * @link https://Dah-kenangnon.com
 */
class User extends BaseEntity
{

    /**
     * @var String User's pseudo
     */
    protected $name;

    /**
     * @var int User age
     */
    protected $age;

    /**
     * @var String User profile's photo path
     */
    protected $photo;

    /**
     * @var String User's email
     */
    protected $email;

    /**
     * @var String User's password
     */
    protected $password;


    /**
     * Role @var string (ROLE_COPAIN | ROLE_ADMIN)
     */
    protected $role =  "ROLE_COPAIN";



    /**
     * Get user's pseudo
     *
     * @return  String
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set user's pseudo
     *
     * @param  String  $name  User's pseudo
     *
     * @return  self
     */
    public function setName(?String $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get user age
     *
     * @return  int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set user age
     *
     * @param  int  $age  User age
     *
     * @return  self
     */
    public function setAge(?int $age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get user profile's photo path
     *
     * @return  String
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set user profile's photo path
     *
     * @param  String  $photo  User profile's photo path
     *
     * @return  self
     */
    public function setPhoto(?String $photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get user's email
     *
     * @return  String
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set user's email
     *
     * @param  String  $email  User's email
     *
     * @return  self
     */
    public function setEmail(?String $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get user's password
     *
     * @return  String
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set user's password
     *
     * @param  String  $password  User's password
     *
     * @return  self
     */
    public function setPassword(?String $password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set role
     *
     * @return  self
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Check if the give user is admin
     */
    public function isAdmin(): bool
    {
        return 0 === strcmp($this->getRole(), "ROLE_ADMIN");
    }
}
