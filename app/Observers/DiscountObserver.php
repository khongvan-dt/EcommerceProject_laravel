<?php

namespace App\Observers;

use App\Models\Discounts;

class DiscountObserver
{
      public function creating(Discounts $discount)
    {
        $discount->status = $discount->isValid() ? 1 : 0;
    }

    public function updating(Discounts $discount)
    {
        $discount->status = $discount->isValid() ? 1 : 0;
    }
}
