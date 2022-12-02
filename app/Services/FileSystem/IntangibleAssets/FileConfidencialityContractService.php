<?php

namespace App\Services\FileSystem\IntangibleAssets;

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
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * 
     * @return bool
     */
    public function deleteConfidencialityContractFile($intangibleAsset)
    {
        if ($intangibleAsset->hasFileOfConfidencialityContract()) {
            /** @var \App\Models\Client\IntangibleAsset\IntangibleAssetConfidentialityContract */
            $confidencialityContract = $intangibleAsset->intangible_asset_confidenciality_contract;

            /** @var string */
            $fullPath = $confidencialityContract->full_path;

            if (!$intangibleAsset->hasDummyFileOfConfidencialityContract()) {
                return $this->deleteFile($this->basePath . $fullPath);
            }
        }
    }
}
