<?php

namespace FoodOrders;

use FoodItems\FoodItem;

class FoodOrder
{
    /** @var FoodItem[] */
    protected array $items;
    protected int $orderTime;

    public function __construct(array $item)
    {
        $this->items = $item;
        $this->orderTime = time();
    }

    public function getItems()
    {
        return $this->items;
    }
}
