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

    public function getId() : ? int {
        return $this->id;
    }

    public function setId(int $id) : Order {
        $this->id = $id;
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