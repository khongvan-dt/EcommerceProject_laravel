<?php
  
namespace App\Console\Commands;

use App\Models\Discounts;
use Illuminate\Console\Command;

class UpdateDiscountStatus extends Command
{
    protected $signature = 'discounts:update-status';
    protected $description = 'Update discount status based on date';

    public function handle()
    {
        $discounts = Discounts::all();
        
        foreach ($discounts as $discount) {
            $discount->updateStatusBasedOnDate();
        }

        $this->info('Discount statuses have been updated successfully');
    }
}
