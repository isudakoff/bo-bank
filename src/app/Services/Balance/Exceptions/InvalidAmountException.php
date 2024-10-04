<?php

namespace Balance\Exceptions;

use Exception;

class InvalidAmountException extends Exception
{
    protected $message = "Invalid amount";
}
