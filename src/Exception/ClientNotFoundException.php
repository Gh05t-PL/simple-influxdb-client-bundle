<?php

namespace Gh05tPL\SimpleInfluxDbClientBundle\Exception;

use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;

class ClientNotFoundException extends \RuntimeException
{
    public function __construct(string $clientName, \Exception $previous = null)
    {
        parent::__construct(sprintf('Client with name \'%s\' not found', $clientName), 0, $previous);
    }
}