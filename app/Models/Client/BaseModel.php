<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'tenant';
}
