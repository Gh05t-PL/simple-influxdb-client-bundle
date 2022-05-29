<?php

namespace Gh05tPL\SimpleInfluxDbClientBundle\Client;


use InfluxDB2\FluxCsvParser;
use InfluxDB2\FluxTable;
use InfluxDB2\Model\Dialect;
use InfluxDB2\Model\Query;

/**
 * The client of the InfluxDB 2.x that implement Query HTTP API endpoint.
 *
 * @package InfluxDB2
 */
interface QueryApi
{
    /**
     * Executes the Flux query and returns the unparsed raw result
     *
     * @param string|Query $query flux query to execute. The data could be represent by string, Query
     * @param string|null $org specifies the source organization
     * @param Dialect|null $dialect csv dialect
     * @return string|null
     */
    public function queryRaw(string|Query $query, ?string $org = null, ?Dialect $dialect = null): ?string;

    /**
     * Executes the Flux query against the InfluxDB 2.x and synchronously map the whole response to FluxTable[]
     * NOTE: This method is not intended for large query results.
     *
     * @param string|Query $query
     * @param string|null $org
     * @param Dialect|null $dialect
     * @return  FluxTable[]|null
     */
    public function query(string|Query $query, ?string $org = null, ?Dialect $dialect = null): ?array;

    /**
     * Executes the Flux query against the InfluxDB 2.x and returns generator to stream the result.
     *
     * @param string| Query $query
     * @param string|null $org
     * @param Dialect|null $dialect
     *
     * @return FluxCsvParser|null generator
     */
    public function queryStream(string|Query $query, ?string $org = null, ?Dialect $dialect = null): ?FluxCsvParser;
}