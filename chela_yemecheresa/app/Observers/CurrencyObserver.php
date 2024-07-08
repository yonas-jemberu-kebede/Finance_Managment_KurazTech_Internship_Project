<?php

namespace App\Observers;


use App\Models\currency_manager;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class CurrencyObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the currency_manager "created" event.
     */
    public function created(currency_manager $currency_manager): void
    {
        //
    }

    /**
     * Handle the currency_manager "updated" event.
     */
    public function updated(currency_manager $currency_manager): void
    {
        

        if($currency_manager->isDirty('is_basecurrency') && $currency_manager->is_basecurrency){
            $oldBase_Currency=currency_manager::where('is_basecurrency',true)->where('id','!=',$currency_manager->id)->first();
$newBase_Currency=$currency_manager;

            if($oldBase_Currency){
                $oldRate=$oldBase_Currency->exchange_rate;
            $newRate=$newBase_Currency->exchange_rate;

            $oldBase_Currency->is_basecurrency= false;
             $oldBase_Currency->save();

              

        $this->handleChangeOfAmount($oldRate,$newRate);

            }
      
            
        }
        
    }

    protected function handleChangeOfAmount($oldRate,$newRate){
DB::table('accounts')->update([
    'opening_balance'=>DB::raw("opening_balance* $newRate/$oldRate")
]);
     
       

    }
    /**
     * Handle the currency_manager "deleted" event.
     */
    public function deleted(currency_manager $currency_manager): void
    {
        //
    }

    /**
     * Handle the currency_manager "restored" event.
     */
    public function restored(currency_manager $currency_manager): void
    {
        //
    }

    /**
     * Handle the currency_manager "force deleted" event.
     */
    public function forceDeleted(currency_manager $currency_manager): void
    {
        //
    }
}
