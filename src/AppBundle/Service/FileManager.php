<?php

namespace AppBundle\Service;

use AppBundle\Entity\Image;
use AppBundle\Entity\Product;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Осущетвляет загрузку файлов в нужное место
 * Знает как найти нужный файл
 * Знает, как построить url к нужному файлу
 *
 * todo не знаю как распилить ответственность.
 */
class FileManager
{
    /** @var  string */
    private $uploadDir;

    /** @var string  */
    private $baseUrl;

    public function __construct(string $uploadDir, string $baseUrl) {
        $this->uploadDir = $uploadDir;
        $this->baseUrl = $baseUrl;
    }

    public function uploadImage(UploadedFile $file, Image $image) : string {
        $dir = $this->getProductUploadDir($image);

        return $this->upload($file, $dir);
    }

    public function upload(UploadedFile $file, string $uploadDir) {

        $fileName = $this->_getRandomName($file);

        $file->move($uploadDir, $fileName);

        return $fileName;
    }

    public function getProductUploadDir(Image $image) : string {
        return $this->_getUploadDir('product/'. $image->getProductId());
    }

    public function getImageUrl(Image $image) : string {
        return $this->baseUrl . '/product/'.$image->getProductId() . '/' . $image->getFileName();
    }

    protected function _getUploadDir(string $subDir): string {
        return $this->uploadDir . DIRECTORY_SEPARATOR . $subDir;
    }

    protected function _getRandomName(UploadedFile $file) : string {
        return  md5(uniqid()) . '.' . $file->guessExtension();
    }
}