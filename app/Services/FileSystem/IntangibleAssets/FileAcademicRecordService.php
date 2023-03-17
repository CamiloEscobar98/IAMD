<?php

namespace App\Services\FileSystem\IntangibleAssets;

use App\Services\FileSystem\AbstractFileSystemService;

class FileAcademicRecordService extends AbstractFileSystemService
{
    /** @var string */
    protected $basePath = 'administrative_records/';

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
    public function storeAcademicRecordFile($path = '', $file, $options = [])
    {
        return $this->storeFile($this->basePath . $path, $file, $options);
    }

    /**
     * @param string $path
     * 
     * @return mixed
     */
    public function getAcademicRecordFile($path = '')
    {
        return $this->getFile($this->basePath . $path);
    }

    /**
     * @param string $path
     * 
     * @return string|null
     */
    public function getAcademicRecordFilePath($path = ''): string|null
    {
        return $this->getFilePath($this->basePath . $path);
    }

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * 
     * @return bool
     */
    public function deleteAcademicRecordFile($intangibleAsset)
    {
        if ($intangibleAsset->hasAcademicRecord()) {
            /** @var \App\Models\Client\IntangibleAsset\IntangibleAssetAcademicRecord */
            $academicRecord = $intangibleAsset->intangible_asset_confidenciality_contract;

            /** @var string */
            $fullPath = $academicRecord->full_path;

            if (!$intangibleAsset->hasDummyFileOfacademicRecord()) {
                return $this->deleteFile($this->basePath . $fullPath);
            }
        }
    }
}
