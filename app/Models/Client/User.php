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
use App\Services\FileSystem\UserProfileImageService;

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
        'profile_image',
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
        return $this->attributes['password'] = Hash::make($value);
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
     * Get the Profile Image
     *
     * @param  string  $value
     * @return string
     */
    public function getProfileImageUrlAttribute($value)
    {
        /** @var UserProfileImageService $userProfileImageService */
        $userProfileImageService = app(UserProfileImageService::class);
        $profileImagePath = $this->getAttribute('profile_image');
        $profileImageUrl = $profileImagePath ? "/storage/users/profile/$profileImagePath" : 'adminlte/dist/img/user2-160x160.jpg';
        return asset($profileImageUrl);
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

    /**
     * Validate if the User has a profile image.
     * 
     * @return bool
     */
    public function hasProfileImage(): bool
    {
        return !is_null($this->getAttribute('profile_image'));
    }

    /**
     * Scope a query to only include Name
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param string $value
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByName($query, string $value)
    {
        $query->where("{$this->getTable()}.name", 'like', "%{$value}%");
    }

     /**
     * Scope a query to only include Email
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param string $value
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByEmail($query, string $value)
    {
        $query->where("{$this->getTable()}.email", 'like', "%{$value}%");
    }

    /**
     * Scope a query to only include Date From
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param string $dateFrom
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSinceDate($query, string $dateFrom)
    {
        $query->where("{$this->getTable()}.created_at", '>=', $dateFrom);
    }

    /**
     * Scope a query to only include Date To
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param string $dateTo
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeToDate($query, string $dateTo)
    {
        $query->where("{$this->getTable()}.created_at", '<=', $dateTo);
    }
}
