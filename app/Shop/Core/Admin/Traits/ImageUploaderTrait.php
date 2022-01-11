<?php
namespace App\Shop\Core\Admin\Traits;

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
     * @param int $size
     * @param \Illuminate\Http\UploadedFile $imageData
     * 
     * @return string
     */
    public function uploadImages($size, $imageData): string
    {
        $path = storage_path($this->storagePath);
        $imageName = $this->getImageName($imageData);
        $pathToStore = $this->checkCurrentDir($path);
        
        foreach($size as $value) {
            $this->uploadImage($imageData, $pathToStore, $imageName, $value);
        }

        return 'storage/images/' . now()->format('Y') . '/' . now()->format('m') . '/' . $imageName;
    }
    
    /**
     * Check current dir for existence
     *
     * @param string $pathToStore
     * 
     * @return string|bool
     */
    private function checkCurrentDir($pathToStore): string|bool
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
    private function getImageName($image): string
    {
        $filename = $image->getClientOriginalName();
        return time() . '-' . $filename;
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
        
