<?php

namespace App\Services\FileSystem;

use Illuminate\Support\Facades\Storage;

use Exception;

abstract class AbstractFileSystemService
{
    /** @var string */
    protected $disk;

    /**
     * @var string $diskName
     * 
     * @return void
     */
    public function setDisk(string $diskName)
    {
        if (Storage::disk($diskName)) {
            $this->disk = $diskName;
        } else {
            throw new Exception("The disk already doesn't exist in the FileSystemConfiguration");
        }
    }

    /**
     * @param string $path
     * @param \Illuminate\Http\UploadedFile $file
     * @param ?array $options
     * 
     * @return bool|Exception
     */
    public function storeFile($path, $file, $options = []): bool
    {
        try {
            return Storage::disk($this->disk)->put($path, file_get_contents($file), $options);
        } catch (Exception $th) {
            throw new Exception("The file hasn't been saved.");
        }
    }

    /**
     * @param string $path
     */
    public function getFile($path)
    {
        try {
            return Storage::disk($this->disk)->get($path);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * @param string $path
     * 
     * @return bool
     */
    public function getFileExists($path): bool
    {
        try {
            return Storage::disk($this->disk)->exists($path);
        } catch (Exception $th) {
            throw new Exception("The file doesn't exist.");
        }
    }

    /**
     * @param string $path
     * 
     * @return string|null
     */
    public function getFilePath($path): string|null
    {
        return $this->getFileExists($path) ?  Storage::disk($this->disk)->path($path) : null;
    }

    // /**
    //  * @param string $path
    //  * 
    //  * @return void|null
    //  */
    // public function downloadFile($path)
    // {
    //     try {
    //         return $this->getFileExists($path) ?  Storage::disk($this->disk)->download($path) : null;
    //     } catch (Exception $th) {
    //         throw new Exception("The file doesn't have been downloaded.");
    //     }
    // }

    /**
     * @param string $path
     * 
     * @return bool
     */
    public function deleteFile($path)
    {
        try {
            return Storage::disk($this->disk)->delete($path);
        } catch (\Throwable $th) {
            throw new Exception("The file hasn't been deleted.");
        }
    }
}
