<?php

namespace Invoices;

class Invoice
{
    protected float $finalPrice;
    protected string $orderTime;

    public function __construct(float $finalPrice)
    {
        $this->finalPrice = $finalPrice;
        $this->orderTime = date("Y年m月d日 H:i");
    }

    public function printInvoice()
    {
        $hr = "----------------------------------\n";
        print(sprintf(
            "%sDate: %s\nFinal Price:  \$%.2f\n%s",
            $hr,
            $this->orderTime,
            $this->finalPrice,
            $hr
        ));
    }
}
