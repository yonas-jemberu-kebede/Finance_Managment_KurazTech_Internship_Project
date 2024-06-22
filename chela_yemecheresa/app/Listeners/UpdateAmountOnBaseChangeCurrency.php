<?php

namespace App\Listeners;

use App\Events\BaseCurrencyChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateAmountOnBaseChangeCurrency
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BaseCurrencyChanged $event): void
   {
    foreach(event->oldbasecurrency->accounts as $account){
        
    }
        
    }
}
