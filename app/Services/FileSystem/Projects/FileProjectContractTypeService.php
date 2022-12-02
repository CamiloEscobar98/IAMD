<?php

namespace App\Services\FileSystem\Projects;

use App\Services\FileSystem\AbstractFileSystemService;

class FileProjectContractTypeService extends AbstractFileSystemService
{
    /** @var string */
    protected $basePath = '';

    public function __construct()
    {
        $this->setDisk('projects');
    }

    /**
     * @param string $path
     * @param \Illuminate\Http\UploadedFile $file
     * @param array $options
     * 
     * @return bool
     */
    public function storeProjectContractTypeFile($path = '', $file, $options = [])
    {
        return $this->storeFile($this->basePath . $path, $file, $options);
    }

    /**
     * @param string $path
     * 
     * @return mixed
     */
    public function getProjectContractTypeFile($path = '')
    {
        return $this->getFile($this->basePath . $path);
    }

    /**
     * @param string $path
     * 
     * @return string|null
     */
    public function getProjectContractTypeFilePath($path = ''): string|null
    {
        return $this->getFilePath($this->basePath . $path);
    }

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $projectContract
     * 
     * @return bool
     */
    public function deleteProjectContractTypeFile($projectContract)
    {
        if ($projectContract->hasFileOfConfidencialityContract()) {
            /** @var \App\Models\Client\IntangibleAsset\IntangibleAssetConfidentialityContract */
            $confidencialityContract = $projectContract->intangible_asset_confidenciality_contract;

            /** @var string */
            $fullPath = $confidencialityContract->full_path;

            if (!$projectContract->hasDummyFileOfConfidencialityContract()) {
                return $this->deleteFile($this->basePath . $fullPath);
            }
        }
    }
}
