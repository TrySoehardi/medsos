<?php

namespace App\Exceptions;

use Exception;

class LoginFailed extends Exception
{
    public function __construct(){
        parent::__construct($message = 'Failed Login', $code = 401);
    }
}
