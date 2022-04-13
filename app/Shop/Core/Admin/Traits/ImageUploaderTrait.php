<?php
namespace App\Shop\Core\Admin\Traits;

use Illuminate\Support\Arr;
use Image;

trait ImageUploaderTrait
{    
    /**
     * Path to image storage
     *
     * @var string
     */
    private $storagePath = 'app/public/images/';
        
    /**
     * Entry point for upload image
     *
     * @param array $size
     * @param \Illuminate\Http\UploadedFile $imageData
     * 
     * @return string
     */
    public function uploadImages($size, $imageData): string
    {
        $path = storage_path($this->storagePath);
        $pathToStore = $this->checkCurrentDir($path);
        $sizeCount = count($size);
        $dataToReturn = '';

        foreach($size as $key => $value) {
            $imageName = $this->getImageName($imageData, $value);
            $this->uploadImage($imageData, $pathToStore, $imageName, $value);
            if($sizeCount > 1) {
                if($key === array_key_last($size)) {
                    $dataToReturn .= 'storage/images/' . now()->format('Y') . '/' . now()->format('m') . '/' . $imageName;
                } else {
                    $dataToReturn .= 'storage/images/' . now()->format('Y') . '/' . now()->format('m') . '/' . $imageName . ',';
                }
            }
        }
    
        if($sizeCount > 1) {
            return $dataToReturn;
        } else {
            return 'storage/images/' . now()->format('Y') . '/' . now()->format('m') . '/' . $imageName;
        }
    }
    
    /**
     * Check current dir for existence
     *
     * @param string $pathToStore
     * 
     * @return string
     */
    private function checkCurrentDir($pathToStore): string
    {
        $currentDir = $pathToStore . '/' . now()->format('Y') . '/' . now()->format('m');

        if(is_dir($currentDir)) {
            return $currentDir;
        } else {
            mkdir($currentDir, 0777, true);
            return $currentDir;
        }
    }
    
    /**
     * Create image name
     *
     * @param \Illuminate\Http\UploadedFile $image
     * 
     * @return string
     */
    private function getImageName($image, $size): string
    {
        $filename = $image->getClientOriginalName();

        return $size . '-' . time() . '-' . $filename;
    }
    
    /**
     * Upload image
     *
     * @param \Illuminate\Http\UploadedFile $image
     * @param string $path
     * @param string $imageName
     * @param int $size
     * 
     * @return void
     */
    private function uploadImage($image, $path, $imageName, $size): void
    {
        $fullPathToImg = $path . '/' . $imageName;
        $imgFile = Image::make($image->getRealPath());
        $imgFile->resize($size, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($fullPathToImg);
    }
}
        
