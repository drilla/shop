<?php

namespace AppBundle\Entity;

class Product
{

    private $id;

    /** @var string */
    private $name;

    /** @var float */
    private $price;

    /** @var string */
    private $description;

    public function __construct(string $name = '', float $price = 0, string $description = '') {
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
    }

    public function getName() {
        return $this->name;
    }

    public function setName(string $name) : self {
        $this->name = $name;
        return $this;
    }

    public function getPrice() : float {
        return $this->price;
    }

    public function setPrice(float $price) : self {
        $this->price = $price;
        return $this;
    }

    public function getDescription() : string {
        return $this->description;
    }

    public function setDescription(string $description) : self {
        $this->description = $description;
        return $this;
    }

    public function getId() : ?int {
        return $this->id;
    }
}