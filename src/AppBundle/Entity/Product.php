<?php

namespace AppBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class Product
{
    const CAT_JOINT = 1;
    const CAT_CREAM = 2;
    const CAT_WRINKLES = 3;

    /** @var  int | null */
    private $id = null;

    /** @var string */
    private $name;

    /** @var float */
    private $price;

    /** @var string */
    private $description;

    /** @var int */
    private $category;

    /** @var string */
    private $picture;

    /** @var  UploadedFile */
    private $imageFile;

    /** @var Image[] */
    private $images = [];

    /** @return Image[] */
    public function getImages(): array {
        return $this->images;
    }

    public function getName() {
        return $this->name;
    }

    public function setName(string $name) : self {
        $this->name = $name;
        return $this;
    }

    public function getPrice() : ?float {
        return $this->price;
    }

    public function setPrice(float $price) : self {
        $this->price = $price;
        return $this;
    }

    public function getDescription() : ?string {
        return $this->description;
    }

    public function setDescription(string $description) : self {
        $this->description = $description;
        return $this;
    }

    public function getId() : ?int {
        return $this->id;
    }

    public function setId(int $id) : self {
        $this->id = $id;
        return $this;
    }

    public function getCategory(): ?int {
        return $this->category;
    }

    public function setCategory(int $category): Product {
        $this->category = $category;
        return $this;
    }

    public function getPicture(): ?string {
        return $this->picture;
    }

    public function setPicture(string $picture): Product {
        $this->picture = $picture;
        return $this;
    }

    public function setImageFile(UploadedFile $imageFile): Product {
        $this->imageFile = $imageFile;
        return $this;
    }

    public function getImageFile(): ?UploadedFile {
        return $this->imageFile;
    }
}