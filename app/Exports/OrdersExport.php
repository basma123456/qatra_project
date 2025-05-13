<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromArray;


class OrdersExport implements FromArray
{
    protected $orders;
    public function __construct(array $invoices)
    {
        $this->orders = $invoices;
    }
    public function array(): array
    {
        return $this->orders;
    }
}
