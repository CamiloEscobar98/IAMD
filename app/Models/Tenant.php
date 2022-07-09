<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',

        'driver',
        'url',
        'host',
        'port',

        'database',
        'username',
        'password',

        'unix_socket',
        'charset',
        'collation',
        'prefix',
        'prefix_indexes',
        'strict',
        'engine',

        'search_path',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
