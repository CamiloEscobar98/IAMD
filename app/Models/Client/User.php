<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'tenant';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Set the Password
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        return $this->setAttribute('password', Hash::make($value));
    }

    /**
     * @return HasOne
     */
    public function user_file(): HasOne
    {
        return $this->hasOne(UserFileReport::class);
    }

    /**
     * @return HasMany
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * @return bool
     */
    public function hasNotifications(): bool
    {
        return $this->notifications->count() > 0;
    }

    /**
     * @return bool
     */
    public function hasUserFileReport(): bool
    {
        return !is_null($this->user_file);
    }

    public function hasFileReport(): bool
    {
        /** @var UserFileReport */
        $userFile = $this->user_file;

        return $this->hasUserFileReport() && !is_null($userFile->file_path && $userFile->file_name);
    }
}
