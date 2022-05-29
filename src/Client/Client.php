<?php

namespace Gh05tPL\SimpleInfluxDbClientBundle\Client;


use InfluxDB2\InvokableScriptsApi;
use InfluxDB2\Model\HealthCheck;
use InfluxDB2\QueryApi;
use InfluxDB2\UdpWriter;
use InfluxDB2\WriteApi;

/**
 * @template T
 */
interface Client
{
    /**
     * Write time series data into InfluxDB through the WriteApi.
     *      $writeOptions = [
     *          'writeType' => methods of write (WriteType::SYNCHRONOUS - default, WriteType::BATCHING)
     *          'batchSize' => the number of data point to collect in batch
     *      ]
     * @param array|null $writeOptions Array containing the write parameters (See above)
     * @param array|null $pointSettings Array of default tags
     * @return WriteApi
     */
    public function createWriteApi(array $writeOptions = null, array $pointSettings = null): WriteApi;

    /**
     * @return UdpWriter
     * @throws \Exception
     */
    public function createUdpWriter();

    /**
     * Get the Query client.
     *
     * @return QueryApi
     */
    public function createQueryApi(): QueryApi;

    /**
     * Create an InvokableScripts API instance.
     *
     * @return InvokableScriptsApi
     */
    public function createInvokableScriptsApi(): InvokableScriptsApi;

    /**
     * Get the health of an instance.
     *
     * @return HealthCheck
     * @deprecated Use `ping()` instead
     */
    public function health(): HealthCheck;

    /**
     * Checks the status of InfluxDB instance and version of InfluxDB.
     *
     * @return array with response headers: 'X-Influxdb-Build', 'X-Influxdb-Version'
     */
    public function ping(): array;

    /**
     * Close all connections into InfluxDB
     */
    public function close();

    public function getConfiguration();

    /**
     * Creates the instance of api service
     *
     * @param  $serviceClass
     * @return object service instance
     */
    public function createService($serviceClass);
}