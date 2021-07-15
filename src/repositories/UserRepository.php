<?php 
namespace App\Repositories;
use App\Entities\User;
use PhpFromZero\Orm\Orm;

/**
 * User repository
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@epatriote.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://Creative.ePatriote.com
 * @link https://Dah-kenangnon.com
 */
class UserRepository extends Orm{

    public function __construct()
    {
        parent::__construct(User::class);
    }
}