<?php

namespace Persons\Customers;

use Restaurants\Restaurant;
use Persons\Person;
use Invoices\Invoice;

class Customer extends Person
{
    protected array $interestedTastesMap;

    public function __construct(string $name, int $age, string $address, array $interestedTastesMap)
    {
        parent::__construct($name, $age, $address);
        $this->interestedTastesMap = $interestedTastesMap;
    }

    /**
     * レストランの提供カテゴリに、自分の興味があるカテゴリだけを返す
     *
     * @param Restaurant $restaurant
     * @return array<string, mixed> 自分が興味あるカテゴリ（レストランにあるもの限定）
     */
    public function interestedCategories(Restaurant $restaurant): array
    {
        $categoryNames =  array_map(
            fn($item) => $item->getName(), // 例: "CheeseBurger"
            $restaurant->getMenu()
        );
        $categoriesMap = array_flip($categoryNames);
        $interestedList = array_intersect_key($this->interestedTastesMap, $categoriesMap);

        return $interestedList;
    }

    /**
     * 自分の興味のあるカテゴリに基づいてレストランに注文を出す
     *
     * @param Restaurant $restaurant
     * @return Invoice
     */
    public function order(Restaurant $restaurant): Invoice
    {
        $allWants = array_map(
            fn($category, $count) => $category,
            array_keys($this->interestedTastesMap),
            $this->interestedTastesMap
        );
        echo $this->name . " wanted to eat " . implode(", ", $allWants) . ".\n";

        // レストランが提供しているもののうち、興味のあるカテゴリと個数だけ渡す
        $categoryCountMap = $this->interestedCategories($restaurant);

        if (!empty($categoryCountMap)) {
            $orderedText = array_map(
                fn($category, $count) => $category . " x " . $count,
                array_keys($categoryCountMap),
                $categoryCountMap
            );

            echo $this->name . " was looking at the menu, and ordered " . implode(", ", $orderedText) . ".\n";
        } else {
            echo $this->name . " wanted something, but nothing was available on the menu.\n";
        }

        return $restaurant->order($categoryCountMap);
    }
}
