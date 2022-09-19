<?php

namespace App\Services\FileSystem\IntangibleAsset;

use App\Services\FileSystem\AbstractFileSystemService;

class FileConfidencialityContractService extends AbstractFileSystemService
{
    /** @var string */
    protected $basePath = 'confidenciality_contracts/';

    public function __construct()
    {
        $this->setDisk('intangible_assets');
    }

    /**
     * @param string $path
     * @param \Illuminate\Http\UploadedFile $file
     * @param array $options
     * 
     * @return bool
     */
    public function storeConfidencialityContractFile($path = '', $file, $options = [])
    {
        return $this->storeFile($this->basePath . $path, $file, $options);
    }

    /**
     * @param string $path
     * 
     * @return mixed
     */
    public function getConfidencialityContractFile($path = '')
    {
        return $this->getFile($this->basePath . $path);
    }

    /**
     * @param string $path
     * 
     * @return string|null
     */
    public function getConfidencialityContractFilePath($path = ''): string|null
    {
        return $this->getFilePath($this->basePath . $path);
    }

    /**
     * @param string $path
     * 
     * @return bool
     */
    public function deleteConfidencialityContractFile($path = '')
    {
        return $this->deleteFile($this->basePath . $path);
    }
}
