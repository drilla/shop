<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Selectable;

/**
 * @author drilla
 */
class Product
{
    const CAT_JOINT = 1;
    const CAT_CREAM = 2;
    const CAT_WRINKLES = 3;

    const CATEGORIES = [
        self::CAT_JOINT,
        self::CAT_CREAM,
        self::CAT_WRINKLES,
    ];

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

    /** @var Image[] */
    private $images;

    public function __construct() {
        $this->images = new ArrayCollection();
    }

    public function getImages(): Collection {
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

    public function getFaceImage() : ?Image {
        $criteria = new Criteria();

        $criteria->where(Criteria::expr()->eq('isFace', true));

        $imagesCollection = $this->getImages();

        if (! ($imagesCollection instanceof Selectable) ) throw new \Exception('Must use selectable interface here.');

        $faceImage =  $imagesCollection->matching($criteria)->first();

        if (!$faceImage) {
            $faceImage = new Image();
            $faceImage->setFileName('');
        }

        return $faceImage ? $faceImage : null;
    }
}