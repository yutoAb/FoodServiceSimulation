<?php

namespace Persons\Employees;

use FoodOrders\FoodOrder;
use Restaurants\Restaurant;
use Invoices\Invoice;
use FoodItems\FoodItem;

class Cashier extends Employee
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

    /**
     * FoodItemのリストからFoodOrderを生成
     *
     * @param FoodItem[] $items
     * @return FoodOrder
     */
    public function generateOrder(array $items): FoodOrder
    {
        echo $this->name . " received the order.\n";
        return new FoodOrder($items);
    }


    /**
     * 請求書を生成する
     *
     * @param FoodOrder $order
     * @return Invoice
     */
    public function generateInvoice(FoodOrder $order): Invoice
    {
        $total = array_reduce($order->getItems(), function ($sum, FoodItem $item) {
            return $sum + $item->getPrice();
        }, 0.0);

        echo $this->name . " made the invoice.\n";

        return new Invoice($total);
    }
}
