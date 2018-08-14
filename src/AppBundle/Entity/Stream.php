<?php

namespace AppBundle\Entity;

/**
 * @author drilla
 */
class Stream
{
    private $id;
    private $streamId;
    private $product;

    public function getId() : int {
        return $this->id;
    }

    public function setId(int $id) : Stream {
        $this->id = $id;
        return $this;
    }

    public function getStreamId() : ? string {
        return $this->streamId;
    }

    public function setStreamId(string $streamId) : Stream {
        $this->streamId = $streamId;
        return $this;
    }

    public function getProduct() : ? Product {
        return $this->product;
    }

    public function setProduct(Product $product) : Stream {
        $this->product = $product;
        return $this;
    }
}