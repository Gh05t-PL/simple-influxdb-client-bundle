<?php

namespace Gh05tPL\SimpleInfluxDbClientBundle\Factory;

use InfluxDB2\Client;

class ClientFactory
{

    public function createClient(
        string $url,
        string $token,
        string $organization,
        string $bucket,
        string $precision,
    ): Client
    {
        return new Client([
            'url' => $url,
            'token' => $token,
            'org' => $organization,
            'bucket' => $bucket,
            'precision' => $precision,
        ]);
    }
}