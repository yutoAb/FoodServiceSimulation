<?php

namespace FoodItems;

abstract class FoodItem
{
    protected string $name;
    protected string $description;
    protected float  $price;
    protected int $cookingTime;

    public function __construct(string $name, string $description, float  $price, int $cookingTime)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->cookingTime = $cookingTime;
    }

    abstract public function getCategory(): string;

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getCookingTime()
    {
        return $this->cookingTime;
    }
}
