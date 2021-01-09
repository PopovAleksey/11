<?php


namespace App\Exceptions\User;


use Exception;


class SignInException extends Exception
{
    public function __construct()
    {
        parent::__construct("", 0, null);
    }
}