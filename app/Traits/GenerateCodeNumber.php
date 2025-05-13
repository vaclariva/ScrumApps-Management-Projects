<?php

namespace App\Traits;

use App\Models\Order;

trait GenerateCodeNumber
{
    public function generateSoNumber()
    {
        $lastOrder = Order::orderBy('id', 'desc')->first();

        if ($lastOrder) {
            $lastNumber = (int)substr($lastOrder->so_number, 3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        if ($newNumber <= 999) {
            return 'SO-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        } else {
            return 'SO-' . $newNumber;
        }
    }
}
