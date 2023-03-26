<?php

namespace App\Services\FileSystem;

use App\Services\FileSystem\AbstractFileSystemService;

class UserProfileImageService extends AbstractFileSystemService
{
    /** @var string */
    protected $basePath = 'users/profile/';

    public function __construct()
    {
        $this->setDisk('public');
    }

    /**
     * @param string $path
     * @param \Illuminate\Http\UploadedFile $file
     * @param array $options
     * 
     * @return bool
     */
    public function storeUserProfileImage($path = '', $file, $options = [])
    {
        return $this->storeFile($this->basePath . $path, $file, $options);
    }

    /**
     * @param string $path
     * 
     * @return mixed
     */
    public function getUserProfileImage($path = '')
    {
        return $this->getFile($this->basePath . $path);
    }

    /**
     * @param string $path
     * 
     * @return string|null
     */
    public function getUserProfileImagePath($path = ''): string|null
    {
        return $this->getFilePath($this->basePath . $path);
    }

    /**
     * @param \App\Models\Client\User $user
     * 
     * @return bool
     */
    public function deleteUserProfileImage($user)
    {
        if ($user->hasProfileImage()) {
            return $this->deleteFile($this->basePath . $user->profile_image);
        }
    }
}
