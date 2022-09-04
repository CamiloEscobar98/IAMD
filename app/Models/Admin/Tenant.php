<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Support\Str;

class Tenant extends BaseModel
{
    use HasFactory;

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql';

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

    /**
     * Get the UpperName
     *
     * @return string
     */
    public function getNameUpperAttribute()
    {
        return Str::upper($this->getAttribute('name'));
    }

    /**
     * Get the LowerName
     *
     * @return string
     */
    public function getNameLowerAttribute()
    {
        return Str::lower($this->getAttribute('name'));
    }
}
