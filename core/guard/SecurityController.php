<?php

namespace PhpFromZero\guard;

use PhpFromZero\Controller\BaseController;
use PhpFromZero\Error\BadCredentialsError;
use PhpFromZero\Logger\Logger;

/**
 * 
 * Security base Controller class
 * 
 * This class can be extends by for example, AuthController for actions like login, register, etc
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@gmail.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://Justin.Dah-kenangnon.com
 * @link https://Paonit.com
 * @link https://Dah-kenangnon.com
 */
abstract class SecurityController extends BaseController
{

    /**
     * @var int The Max length of the raw password
     */
    private const MAX_PASSWORD_LENGTH = 4096;


    /**
     * Hash the password using argon2i
     * 
     * @param String $raw The password in clear text
     * 
     * @return String The hashed version of the password
     * 
     */
    public function hashPassword(string $raw): string
    {
        // Make sure user don't provide a too long password
        if (\strlen($raw) > self::MAX_PASSWORD_LENGTH) {
            throw new BadCredentialsError('The password is too long.');
        }

        // Get a formatted password hash (for storage) Argon2i
        return password_hash($raw, PASSWORD_ARGON2I);
    }



    /**
     * Check if the hashed and raw password matched
     * 
     * @param String $hashed The hashed version of the password, stored in database for each user
     * 
     * @param String $raw The text cleared password provided by the user to be authenticated
     * 
     * @return bool Whether we can authenticate user or not
     */
    public function verifyPassWord(string $hashed, string $raw): bool
    {
        // Don't allow emply password
        if ('' === $raw) {
            return false;
        }


        // Don't allow too long password
        if (\strlen($raw) > self::MAX_PASSWORD_LENGTH) {
            return false;
        }

        // Check if password is verify
        return password_verify($raw, $hashed);
    }
}
