# Simple InfluxDB Client Bundle

This bundle is based on [influxdata/influxdb-client-php](https://github.com/influxdata/influxdb-client-php)



## Installation (until flex isn't added)
1. `composer require gh05tpl/simple-influxdb-client-bundle`
2. Add bundle in `bundles.php` with this line `Gh05tPL\SimpleInfluxDbClientBundle\SimpleInfluxDbClientBundle::class => ['all' => true],`
2. Add config file under `config/packages/gh05tpl_influxdb_client.yaml` and use config example to populate it



## Usage

To inject specific client defined in configuration use camelCase version of the name in argument (e.g. `$mySecondClient`) typed with 
`\InfluxDB2\Client` class and then use it as described in original repo
[influxdata/influxdb-client-php](https://github.com/influxdata/influxdb-client-php#usage)



## Config file example

```yaml
gh05tpl_influxdb_client:
  clients:
    my_first_client:
      host: 'http://influx'
      port: '8086'
      token: 'TOKEN'
      organization: 'my-org'
      bucket: 'my-bucket'
      precision: 's'
      timeout: 2
    my_second_client:
      host: 'http://influx'
      port: '8086'
      token: 'TOKEN'
      organization: 'my-org2'
      bucket: 'my-bucket2'
      precision: 's'
      timeout: 2
```