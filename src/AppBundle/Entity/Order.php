<?php

namespace AppBundle\Entity;

/**
 * @author drilla
 */
class Order
{
    private $id;
    private $name;
    private $phone;
    private $comment;
    private $product;
    private $count;

    public function getCount() : ? int {
        return $this->count;
    }

    public function setCount(int $count = null) : Order {
        $this->count = $count;
        return $this;
    }

    public function getId() : ? int {
        return $this->id;
    }

    public function setId(int $id) : Order {
        $this->id = $id;
        return $this;
    }

    public function getProduct() : ? Product  {
        return $this->product;
    }

    public function setProductId(Product $product = null) : Order {
        $this->product = $product;
        return $this;
    }

    public function getComment() : ? string {
        return $this->comment;
    }

    public function setComment($comment) : Order {
        $this->comment = $comment;
        return $this;
    }

    public function getName(): ? string {
        return $this->name;
    }

    public function setName($name) : Order  {
        $this->name = $name;
        return $this;
    }

    public function getPhone() : ? string {
        return $this->phone;
    }

    public function setPhone(string $phone) : Order  {
        $this->phone = $phone;
        return $this;
    }
}