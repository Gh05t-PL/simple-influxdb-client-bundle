<?php

namespace Gh05tPL\SimpleInfluxDbClientBundle\Registry;

use Gh05tPL\SimpleInfluxDbClientBundle\Exception\ClientNotFoundException;
use InfluxDB2\Client;

class ClientRegistry
{
    /** @var Client[] */
    private array $clients = [];

    public function addClient(string $name, Client $client): void
    {
        $this->clients[$name] = $client;
    }

    public function getClient(string $name): Client
    {
        if (!array_key_exists($name, $this->clients)) {
            throw new ClientNotFoundException($name);
        }

        return $this->clients[$name];
    }
}