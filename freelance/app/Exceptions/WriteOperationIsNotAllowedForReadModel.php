<?php

namespace App\Exceptions;

final class WriteOperationIsNotAllowedForReadModel extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct("Write operation is not allowed for read model");
    }
}