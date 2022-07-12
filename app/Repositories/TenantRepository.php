<?php

namespace App\Repositories;

use App\Models\Tenant;

class TenantRepository extends  AbstractRepository
{
    public function __construct(Tenant $model)
    {
        $this->model = $model;
    }

    /**
     * Get tenant by name.
     * 
     * @param string $name
     * 
     * @return Tenant
     */
    public function getByName($name)
    {
        return $this->model->all()->where('name', $name)->first();
    }

    public function getArrayConfigurationDatabase(Tenant $model)
    {
        return [
            'driver' => $model->driver,
            'url' => $model->url,
            'host' => $model->host,
            'port' => $model->port,
            'database' => $model->database,
            'username' => $model->username,
            'password' => $model->password,
            'unix_socket' => $model->unix_socket,
            'charset' => $model->charset,
            'collation' => $model->collation,
            'prefix' => $model->prefix,
            'prefix_indexes' => $model->prefix_indexes,
            'strict' => $model->strict,
            'engine' => $model->engine,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                \PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ];
    }
}
