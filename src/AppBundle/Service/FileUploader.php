<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    /** @var  string */
    private $targetDirectory;

    public function __construct(string $uploadDir) {
        $this->targetDirectory = $uploadDir;
    }

    public function upload(UploadedFile $file, string $subDir) {

        $fileName = $this->_getRandomName($file);

        $file->move($this->getTargetDirectory($subDir), $fileName);

        return $fileName;
    }

    public function getTargetDirectory(string $subDir): string {
        return $this->targetDirectory . DIRECTORY_SEPARATOR . $subDir;
    }

    protected function _getRandomName(UploadedFile $file) : string {
        return  md5(uniqid()) . '.' . $file->guessExtension();
    }
}