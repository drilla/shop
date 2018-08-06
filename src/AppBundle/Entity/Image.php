<?php

namespace AppBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @author drilla
 * Информация об изображении
 */
class Image
{
    /** @var  int */
    private $id;

    /** @var  string */
    private $fileName;

    /**
     * @var  UploadedFile
     */
    private $file;

    /** @var  bool */
    private $isFace = false;

    /** @var  Product */
    private $product;

    public function __construct() {
        $this->product = new Product();
    }

    public function getProduct(): Product {
        return $this->product;
    }

    public function setProduct(Product $product): Image {
        $this->product = $product;
        return $this;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id) : Image {
        $this->id = $id;
        return $this;
    }

    public function isFace(): bool {
        return $this->isFace;
    }

    public function setIsFace(bool $isFaceImage): Image {
        $this->isFace = $isFaceImage;
        return $this;
    }

    public function getFile(): ?UploadedFile {
        return $this->file;
    }

    public function setFile(UploadedFile $file): Image {
        $this->file = $file;
        return $this;
    }

    public function getFileName(): ?string {
        return $this->fileName;
    }
    public function setFileName(string $fileName) : Image {
        $this->fileName = $fileName;
        return $this;
    }

}