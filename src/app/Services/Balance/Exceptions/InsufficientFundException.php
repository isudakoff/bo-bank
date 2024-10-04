<?php

namespace App\Services\Balance\Exceptions;

use Exception;

class InsufficientFundException extends Exception
{
    protected $message = "Insufficient fund";
}
