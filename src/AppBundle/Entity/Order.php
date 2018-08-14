<?php

namespace AppBundle\Entity;

/**
 * @author drilla
 */
class Order
{
    const IS_SENT = 1;

    private $id;
    private $name;
    private $ip;

    private $phone;
    private $comment;
    private $product;
    private $count;
    private $is_sent = false;
    public function getId() : ? int {
        return $this->id;
    }

    public function setId(int $id) : Order {
        $this->id = $id;
        return $this;
    }

    public function isSent() : bool {
        return $this->is_sent;
    }

    public function setIsSent(bool $isSent) : Order {
        $this->is_sent = $isSent;
        return $this;
    }

    public function getCount() : ? int {
        return $this->count;
    }

    public function setCount(int $count = null) : Order {
        $this->count = $count;
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

    public function getIp() : ? string {
        return $this->ip;
    }

    public function setIp($ip) : Order {
        $this->ip = $ip;
        return $this;
    }
}