<?php

namespace App\Exceptions;

final class ServiceException extends \RuntimeException
{
    /**
     * @var string
     */
    private $userMessage;

    public function __construct(string $userMessage)
    {
        $this->userMessage = $userMessage;
        parent::__construct('Service exception');
    }

    public function getUserMessage(): string
    {
        return $this->userMessage;
    }
}