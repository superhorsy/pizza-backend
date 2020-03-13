<?php


namespace App\Exceptions;


class ApiException extends \Exception
{
    const VALIDATION_ERROR = 9001;
    const AUTH_ERROR = 9002;
}
