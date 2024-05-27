<?php

namespace App\Exceptions;

use Exception;

class Errors extends Exception
{
    public function __construct($message, $code){
        parent::__construct($message, $code);
    }
}
