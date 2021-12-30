<?php

namespace App\Shop\Admin\Log\Services;

use App\Shop\Admin\Log\Exceptions\FileNotFoundException;

class LogService
{        
    /**
     * Get content from log files
     *
     * @throws FileNotFoundException
     * 
     * @return array
     */
    public function getLogfilesContent(string $pathToFile): array
    {
        try {
            $contentArray = array();
            $filesArray = scandir($pathToFile);
                foreach ($filesArray as $value) {
                    if(is_file($pathToFile . '/' . $value)) {
                        $file = new \SplFileInfo($pathToFile . '/' . $value);
                        $extension = $this->getFileExtension($file);
                            if($extension == 'log') {
                                $fileContent = file_get_contents($file);
                                $fileName = $this->getFileName($file);
                                $contentArray[$fileName] = $fileContent;
                            }
                    } else {
                        continue;
                    }
                }
            return $contentArray;
        } catch(\ErrorException $e) {
            throw new FileNotFoundException($e->getMessage());
        }
    }

    /**
     * Delete content from log file
     *
     * @param  string $file
     * 
     * @throws ErrorException
     * @throws FileNotFoundException
     * 
     * @return string
     */
    public function clearLogFile(string $file): bool
    {
        try {
            if($this->checkForFileExistence($file)) {
                file_put_contents($file, '');
                return true;
            }
            throw new \ErrorException();
        } catch(\ErrorException $e) {
            throw new FileNotFoundException($e->getMessage());
        }
  
    }
    
    /**
     * Get file extension
     *
     * @param  SplFileInfo $file
     * 
     * @return string
     */
    private function getFileExtension(\SplFileInfo $file): string
    {
        return $file->getExtension();
    }
    
    /**
     * Get file name
     *
     * @param  SplFileInfo $file
     * 
     * @return string
     */
    private function getFileName(\SplFileInfo $file): string
    {
        return $file->getFilename();
    }
    
    /**
     * Check for log file existence
     *
     * @param  string $file
     * 
     * @return bool
     */
    private function checkForFileExistence(string $file): bool
    {
        return file_exists($file);
    }
}
