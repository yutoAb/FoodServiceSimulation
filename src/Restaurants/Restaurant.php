<?php

namespace Restaurants;

use FoodItems\FoodItem;
use Persons\Employee;
use Invoices\Invoice;
use Persons\Employees\Cashier;
use Persons\Employees\Chef;

class Restaurant
{
    /** @var FoodItem[] */
    protected array $menu;

    /** @var Employee[] */
    protected array $employees;

    public function __construct(array $menu, array $employees)
    {
        $this->menu = $menu;
        $this->employees = $employees;
    }

    /**
     * メニューを返す
     *
     * @return FoodItem[]
     */
    public function getMenu(): array
    {
        return $this->menu;
    }

    /**
     * レストランが提供する食品カテゴリ名一覧を返す
     *
     * @return string[] カテゴリ名
     */
    public function getCategoryNames(): array
    {
        $categoryNames = [];

        foreach ($this->menu as $item) {
            $categoryName = $item->getCategory();
            if (!in_array($categoryName, $categoryNames, true)) {
                $categoryNames[] = $categoryName;
            }
        }

        return $categoryNames;
    }

    /**
     * 興味あるカテゴリ名とその注文数をもとに、注文処理を行い Invoice を返す。
     * レジが FoodOrder を生成し、シェフが調理し、レジが請求書を発行する。
     *
     * @param array<string, int> $categoryCountMap カテゴリ名 => 個数
     * @return Invoice
     */
    public function order(array $categoryCountMap): Invoice
    {
        $orderedItems = [];
        $remainingMap = $categoryCountMap;

        foreach ($this->menu as $item) {
            $categoryName = $item->getCategory();
            if (isset($remainingMap[$categoryName]) && $remainingMap[$categoryName] > 0) {
                for ($i = 0; $i < $remainingMap[$categoryName]; $i++) {
                    $orderedItems[] = clone $item;
                }
                unset($remainingMap[$categoryName]);
            }
            if (empty($remainingMap)) {
                break;
            }
        }

        // レジ担当とシェフを取得
        $cashier = $this->getCashier();
        $chef = $this->getChef();

        // FoodOrder の生成と調理
        $foodOrder = $cashier->generateOrder($orderedItems, $this);
        $chef->prepareFood($foodOrder); // 調理ログと時間出力

        // 請求書の発行
        return $cashier->generateInvoice($foodOrder);
    }

    /**
     * レジ担当を取得（最初の Cashier を想定）
     */
    protected function getCashier(): Cashier
    {
        foreach ($this->employees as $e) {
            if ($e instanceof Cashier) {
                return $e;
            }
        }
        throw new \RuntimeException("No cashier found in the restaurant.");
    }

    /**
     * シェフを取得（最初の Chef を想定）
     */
    protected function getChef(): Chef
    {
        foreach ($this->employees as $e) {
            if ($e instanceof Chef) {
                return $e;
            }
        }
        throw new \RuntimeException("No chef found in the restaurant.");
    }
}
