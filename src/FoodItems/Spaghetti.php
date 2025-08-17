<?php

namespace FoodItems;

class Spaghetti extends FoodItem
{
    public function __construct()
    {
        parent::__construct(
            "Spaghetti",
            "This is a type of pasta, a noodle used in Italian cuisine.",
            13.0,
            3
        );
    }

    public function getCategory(): string
    {
        return 'Spaghetti';
    }
}
