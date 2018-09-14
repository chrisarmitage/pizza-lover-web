<?php

namespace Application\Entity;

class BasketLine
{
    protected $mobile;
    protected $itemId;
    protected $quantity;

    /**
     * BasketLine constructor.
     * @param $mobile
     * @param $itemId
     * @param $quantity
     */
    public function __construct($mobile, $itemId, $quantity)
    {
        $this->mobile = $mobile;
        $this->itemId = $itemId;
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @return mixed
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
}
