<?php

namespace FoodItems;

class Fettuccine extends FoodItem
{
    public function __construct()
    {
        parent::__construct(
            "Fettuccine",
            "This is popular in Tuscan and Roman cuisine.",
            10.0,
            4
        );
    }

    public function getCategory(): string
    {
        return 'Fettuccine';
    }
}
