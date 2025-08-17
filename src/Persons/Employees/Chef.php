<?php

namespace Persons\Employees;

use FoodOrders\FoodOrder;

class Chef extends Employee
{
    public function __construct(
        string $name,
        int $age,
        string $address,
        int $employeeId,
        float $salary
    ) {
        parent::__construct($name, $age, $address, $employeeId, $salary);
    }

    public function preparefood(FoodOrder $foodOrder): string
    {
        $totalTime = 0;
        foreach ($foodOrder->getItems() as $item) {
            $name = $item->getName(); // 例: "CheeseBurger"
            $time = $item->getCookingTime(); // 例: 3
            echo $this->name . " was cooking " . $name . ".\n";
            $totalTime += $time;
        }

        echo $this->name . " took " . $totalTime . " minutes to cook.\n";
        return $totalTime;
    }
}
