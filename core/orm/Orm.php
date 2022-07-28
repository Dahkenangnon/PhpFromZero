<?php

namespace PhpFromZero\Orm;

use PhpFromZero\Entity\BaseEntity;
use PhpFromZero\Orm\Database;


/**
 * 
 * This is the main bridge to communicate with the database.
 * 
 * All the repository of our project will extends this class
 * 
 * Each repository can define custom query action based on an @var BaseEntity
 * 
 * 
 * These ones defined here, will be so available on every repository
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@gmail.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://Justin.Dah-kenangnon.com
 * @link https://Paonit.com
 * @link https://Dah-kenangnon.com
 */
class Orm
{
    /**
     * @var \PDO the pdo connection to the database
     */
    protected $connection;

    /**
     * 
     * @var String
     * The table to query on the database.
     * This table is related to the @var $entityClass
     */
    protected $table;


    /**
     * @var \ReflectionClass The entity reflection of the related entity
     */
    protected $entityReflection;


    /**
     * @var \ReflectionProperty[] The reflected entity props
     */
    protected $entityReflectionProps;


    /**
     * The reflected entity class
     */
    protected $entityClass;




    public function __construct($EntityClass)
    {
        // Create database connection and initialize it
        $database = new Database();
        $database::init();

        // Get the connection object
        $this->connection = $database->connect();

        // Reflected entity
        $this->entityClass = $EntityClass;
        $this->entityReflection = new \ReflectionClass($this->entityClass);

        // Reflected entity's properties
        $this->entityReflectionProps   = $this->entityReflection->getProperties(\ReflectionProperty::IS_PROTECTED);

        // The representation of the entity in the database with the lowercase version of the entity shortname
        $this->table = strtolower($this->entityReflection->getShortName());
    }



    /**
     * 
     * @param $object The new $this->entityClass to create
     * 
     * @return true|false
     * 
     *  Insert an instance of $this->entityReflection in the database
     */
    public function create($object)
    {
        // Building query
        $keys = "(";
        $values = "(";

        foreach ($this->entityReflectionProps as $prop) {

            $propName = $prop->getName(); // Get the class prop name

            // Using it 
            $keys .= $propName . ",";
            $values .= ":" . $propName . ",";
        }


        // Replace the last commas
        $keys = substr_replace($keys, ')', -1, 1);
        $values = substr_replace($values, ')', -1, 1);

        // Prepare the statment
        $prepared = $this->connection->prepare("INSERT INTO " . $this->table . " $keys VALUES $values");


        // Reflected entity based now the object not in the class
        $objectReflection = new \ReflectionClass($object);

        // Reflected entity's properties
        $objectReflectionProps   = $objectReflection->getProperties(\ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED);


        // Bind values
        foreach ($objectReflectionProps as $prop) {

            $propName = $prop->getName();

            $getter = "get" . ucfirst($propName);
            $propValue = $object->$getter();
            $prepared->bindValue(':' . $propName, $propValue);
        }

        // execute
        return $prepared->execute();
    }



    /**
     * Find all rows in the tables
     * 
     * @return array|null
     */
    public function findAll()
    {
        $sql = 'SELECT * FROM ' . $this->table . ' ORDER BY id';
        $users = $this->connection->query($sql, \PDO::FETCH_CLASS, $this->entityClass);
        return $users->fetchAll();
    }


    /**
     * Find one object by it id
     * 
     * @param int $int
     * 
     * @return $this->entityClass|null
     */
    public function find(int $id)
    {

        $prepared = $this->connection->prepare("SELECT * FROM " . $this->table . " WHERE id = :id");

        $prepared->bindValue(':id', $id);
        $prepared->setFetchMode(\PDO::FETCH_CLASS, $this->entityClass);
        $prepared->execute();
        return $prepared->fetch();
    }




    /**
     * 
     * Find element from requiring certains cretierias
     * 
     * 
     * @param array $conditions [ $key => $value ]
     * 
     * Ex:  ["name" => "Dah-kenangnon", "age"=>24]
     * 
     * @param array $orderBy [ $key => $value ]
     * 
     * Ex:  ["name" => "ASC", "age"=>DESC]
     * 
     * @param int $limit 
     * 
     * @param int $offset 
     * 
     * @return array|null
     * 
     */
    public function findBy(array $conditions =  null, array $orderBy = null, int $limit = null, int $offset = null)
    {

        // This hold our field which need to be bind
        $arrayOfToBind = [];


        // The sql 
        $sql = "SELECT * FROM " . $this->table;


        // Take care about conditions on where
        if ($conditions) {
            $sql .= " WHERE ";

            foreach ($conditions as $key => $value) {
                $sql .= "$key = :$key AND";
                array_push($arrayOfToBind, ["key" => $key, "value" => $value]);
            }

            // Remove the leading AND
            $sql = substr_replace($sql, '', -3, 3);
        }



        // Add order by if needed
        if ($orderBy) {
            $sql .= " ORDER BY ";
            foreach ($orderBy as $key => $value) {

                $sql .= "$key $value,";
            }

            // Remove the last comma
            $sql = substr_replace($sql, '', -1, 1);
        }




        // Add limit if needed
        if ($limit) {
            $sql .= " LIMIT " . $limit;
        }

        // Add offset if needed
        if ($offset) {
            $sql .= " OFFSET " . $offset;
        }


        // Prepare  the query 
        $prepared = $this->connection->prepare($sql);


        // BindParams
        foreach ($arrayOfToBind as $toBeBind) {
            $prepared->bindValue(':' . $toBeBind["key"], $toBeBind["value"]);
        }

        // Execute query
        $prepared->setFetchMode(\PDO::FETCH_CLASS, $this->entityClass);
        $prepared->execute();
        return $prepared->fetchAll();
    }




    /**
     * Find one element by certains criteria
     * 
     * @param array $conditions [ $key => $value ]
     * 
     * Ex:  ["name" => "Dah-kenangnon", "age"=>24]
     * 
     * @param array $orderBy [ $key => $value ]
     * 
     * Ex:  ["name" => "ASC", "age"=>DESC]
     * 
     * @return $this->entityClass|null
     */
    public function findOneBy(array $conditions =  null, array $orderBy = null)
    {

        // This hold our field which need to be bind
        $arrayOfToBind = [];

        // The sql 
        $sql = "SELECT * FROM " . $this->table;


        // Take care about conditions on where
        if ($conditions) {
            $sql .= " WHERE ";

            foreach ($conditions as $key => $value) {
                $sql .= "$key = :$key AND";
                array_push($arrayOfToBind, ["key" => $key, "value" => $value]);
            }

            // Remove the leading AND
            $sql = substr_replace($sql, '', -3, 3);
        }



        // Add order by if needed
        if ($orderBy) {
            $sql .= " ORDER BY ";
            foreach ($orderBy as $key => $value) {

                $sql .= "$key $value,";
            }

            // Remove the last comma
            $sql = substr_replace($sql, '', -1, 1);
        }


        // Prepare  the query 
        $prepared = $this->connection->prepare($sql);


        // BindParams
        foreach ($arrayOfToBind as $toBeBind) {
            $prepared->bindValue(':' . $toBeBind["key"], $toBeBind["value"]);
        }

        // Execute query
        $prepared->setFetchMode(\PDO::FETCH_CLASS, $this->entityClass);
        $prepared->execute();
        $entities = $prepared->fetchAll();

        return $entities[0] ?? null;
    }



    /**
     * Update the @param $object  which is an object
     * 
     * @return bool
     */
    public function update($object)
    {

        // The sql
        $sql = "UPDATE " . $this->table . " SET ";

        // Include all properties in the updating query
        foreach ($this->entityReflectionProps as $prop) {

            $propName = $prop->getName();

            if ($propName == "id") continue; // This avoid updating id as it is an A.U field in mysql

            $sql .= "$propName = :$propName,";
        }

        // Remove the last comma
        $sql = substr_replace($sql, '', -1, 1);

        // Add where id match
        $sql .= " WHERE id = :id";



        // Prepare the statment
        $prepared = $this->connection->prepare($sql);

        // Reflected entity
        $objectReflection = new \ReflectionClass($object);

        // Reflected entity's properties
        $objectReflectionProps   = $objectReflection->getProperties(\ReflectionProperty::IS_PROTECTED);


        // Binding values
        foreach ($objectReflectionProps as $prop) {

            $propName = $prop->getName();

            $getter = "get" . ucfirst($propName);

            $propValue = $object->$getter();

            $prepared->bindValue(':' . $propName, $propValue);
        }

        // execute
        return $prepared->execute();
    }



    /**
     * Delete the object of id @var $id
     * 
     * 
     * @param int $id
     * 
     * @return bool
     */
    public function delete(int $id): bool
    {
        // The sql
        $sql = "DELETE FROM " . $this->table . " WHERE id = :id ";

        // Prepare the statment
        $prepared = $this->connection->prepare($sql);

        // Bind value
        $prepared->bindValue(':id', $id);

        // execute
        return $prepared->execute();
    }
}
