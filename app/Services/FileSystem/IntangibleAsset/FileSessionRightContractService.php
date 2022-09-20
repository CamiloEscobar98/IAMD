<?php

namespace App\Services\FileSystem\IntangibleAsset;

use App\Services\FileSystem\AbstractFileSystemService;

class FileSessionRightContractService extends AbstractFileSystemService
{
    /** @var string */
    protected $basePath = 'session_right_contracts/';

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
    public function storeSessionRightContractFile($path = '', $file, $options = [])
    {
        return $this->storeFile($this->basePath . $path, $file, $options);
    }

    /**
     * @param string $path
     * 
     * @return mixed
     */
    public function getSessionRightContractFile($path = '')
    {
        return $this->getFile($this->basePath . $path);
    }

    /**
     * @param string $path
     * 
     * @return string|null
     */
    public function getSessionRightContractFilePath($path = ''): string|null
    {
        return $this->getFilePath($this->basePath . $path);
    }

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * 
     * @return bool
     */
    public function deleteSessionRightContractFile($intangibleAsset)
    {
        if ($intangibleAsset->hasFileOfSessionRightContract()) {
            /** @var \App\Models\Client\IntangibleAsset\IntangibleAssetConfidentialityContract */
            $sessionRightContract = $intangibleAsset->intangible_asset_session_right_contract;
            
            /** @var string */
            $fullPath = $sessionRightContract->full_path;

            if (!$intangibleAsset->hasDummyFileOfSessionRightContract()) {
                return $this->deleteFile($this->basePath . $fullPath);
            }
        }
    }
}
