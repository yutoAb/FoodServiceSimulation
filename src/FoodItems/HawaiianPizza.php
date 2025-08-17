<?php

namespace FoodItems;

class HawaiianPizza extends FoodItem
{
    public function __construct()
    {
        parent::__construct(
            "HawaiianPizza",
            "This is a pizza made with tomato sauce, cheese, pineapple, and ham.",
            20.0,
            5
        );
    }

    public function getCategory(): string
    {
        return 'HawaiianPizza';
    }
}
