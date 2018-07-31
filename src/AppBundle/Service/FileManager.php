<?php

namespace AppBundle\Service;

use AppBundle\Entity\Product;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileManager
{
    /** @var  string */
    private $uploadDir;
    private $baseUrl;

    public function __construct(string $uploadDir, string $baseUrl) {
        $this->uploadDir = $uploadDir;
        $this->baseUrl = $baseUrl;
    }

    public function uploadProductImage(UploadedFile $file, Product $product) : string {
        $dir = $this->getProductUploadDir($product);

        return $this->upload($file, $dir);
    }

    public function upload(UploadedFile $file, string $uploadDir) {

        $fileName = $this->_getRandomName($file);

        $file->move($uploadDir, $fileName);

        return $fileName;
    }

    public function getUploadDir(string $subDir): string {
        return $this->uploadDir . DIRECTORY_SEPARATOR . $subDir;
    }

    public function getProductUploadDir(Product $product) : string {
        return $this->getUploadDir('product/'. $product->getId());
    }

    public function getProductImageUrl(Product $product) : string {
        return $this->baseUrl . '/product/'.$product->getId() . '/' . $product->getPicture();
    }

    protected function _getRandomName(UploadedFile $file) : string {
        return  md5(uniqid()) . '.' . $file->guessExtension();
    }
}