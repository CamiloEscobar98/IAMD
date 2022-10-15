<?php

namespace App\Services\FileSystem\IntangibleAsset;

use App\Services\FileSystem\AbstractFileSystemService;

class ReportFileCustomReportService extends AbstractFileSystemService
{
    /** @var string */
    protected $basePath = 'reports/custom/';

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
    public function storeFileReport($path, $file, $options)
    {
        return $this->storeGeneratedFile($this->basePath . $path, $file, $options);
    }

    /**
     * @param string $path
     * 
     * @return mixed
     */
    public function getFileReport($path = '')
    {
        return $this->getFile($this->basePath . $path);
    }

    /**
     * @param string $path
     * 
     * @return string|null
     */
    public function getFileReportPath($path = ''): string|null
    {
        return $this->getFilePath($this->basePath . $path);
    }

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * 
     * @return bool
     */
    public function deleteFileReport($intangibleAsset)
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
