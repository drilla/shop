<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    /** @var  string */
    private $targetDirectory;

    public function __construct(string $targetDirectory) {
        $this->targetDirectory = $targetDirectory;
    }

    public function upload(UploadedFile $file) {

        $fileName = $this->_getRandomName($file);

        $file->move($this->getTargetDirectory(), $fileName);

        return $fileName;
    }

    public function getTargetDirectory(): string {
        return $this->targetDirectory;
    }

    protected function _getRandomName(UploadedFile $file) : string {
        return  md5(uniqid()) . '.' . $file->guessExtension();
    }
}