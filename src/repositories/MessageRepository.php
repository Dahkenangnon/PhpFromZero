<?php 
namespace App\Repositories;

use App\Entities\Message;
use PhpFromZero\Orm\Orm;

/**
 * Message repository
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@gmail.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://Justin.Dah-kenangnon.com
 * @link https://Paonit.com
 * @link https://Dah-kenangnon.com
 */
class MessageRepository extends Orm {

    public function __construct()
    {
        parent::__construct(Message::class);
    }
}