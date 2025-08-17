<?php
spl_autoload_extensions(".php");
spl_autoload_register(function ($class) {
    $base_dir = __DIR__ . '/src/';
    $file = $base_dir . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

$cheeseBurger = new \FoodItems\CheeseBurger();
$fettuccine = new \FoodItems\Fettuccine();
$hawaiianPizza = new \FoodItems\HawaiianPizza();
$spaghetti = new \FoodItems\Spaghetti();

$Inavah = new \Persons\Employees\Chef("Inayah Lozano", 40, "Osaka", 1, 30);
$Nadia = new \Persons\Employees\Cashier("Nadia Valentine", 21, "Tokyo", 1, 20);

$saizeriya = new \Restaurants\Restaurant(
    [
        $cheeseBurger,
        $fettuccine,
        $hawaiianPizza,
        $spaghetti
    ],
    [
        $Inavah,
        $Nadia
    ]
);

$interestedTastesMap = [
    "Margherita" => 1,
    "CheeseBurger" => 2,
    "Spaghetti" => 1
];

$Tom = new \Persons\Customers\Customer("Tom", 20, "Saitama", $interestedTastesMap);

$invoice = $Tom->order($saizeriya);
$invoice->printInvoice();

/*
意図する挙動

Tom wanted to eat Margherita, CheeseBurger, Spaghetti.
Tom was looking at the menu, and ordered CheeseBurger x 2, Spaghetti x 1.
Nadia Valentine received the order.
Inayah Lozano was cooking CheeseBurger.
Inayah Lozano was cooking CheeseBurger.
Inayah Lozano was cooking Spaghetti.
Inayah Lozano took 7 minutes to cook.
Nadia Valentine made the invoice.

Date: 2023/08/07 00:04:13
Final Price: $43.00

*/